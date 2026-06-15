<?php

namespace App\Controllers;

use App\Models\Exam;
use Exception;
use PDOException;

class ExamController
{
  private $examModel;

  public function __construct()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    $this->examModel = new Exam();
  }

  // Display exam lists in teacher panel
  public function index()
  {
    $this->checkTeacherAuth();

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 12;
    $offset = ($page - 1) * $perPage;

    $exams = $this->examModel->getExamsByTeacher($_SESSION['user_id'], $perPage, $offset);
    $totalExams = $this->examModel->getExamsCountByTeacher($_SESSION['user_id']);
    $totalPages = ceil($totalExams / $perPage);

    require_once '../app/Views/dashboard/teacher/quests.php';
  }

  // Display exam create form (only teacher)
  public function showCreateForm()
  {
    $this->checkTeacherAuth();
    require_once '../app/Views/dashboard/teacher/quest-create.php';
  }

  // ذخیره آزمون جدید
  public function store()
  {
    $this->checkTeacherAuth();

    $title = trim($_POST['title'] ?? '');
    $course_name = trim($_POST['course_name'] ?? '');
    $pass_score = intval($_POST['pass_score'] ?? 50);
    $questions = $_POST['questions'] ?? [];

    $errors = [];

    if (empty($title)) {
      $errors['title'] = 'عنوان آزمون الزامی است.';
    }

    if (empty($course_name)) {
      $errors['course_name'] = 'نام دوره الزامی است.';
    }

    if (empty($questions)) {
      $errors['questions'] = 'حداقل یک سوال باید اضافه کنید.';
    }

    if (!empty($errors)) {
      $_SESSION['exam_errors'] = $errors;
      $_SESSION['exam_data'] = $_POST;
      redirect('/panel/quests/create');
    }

    try {
      $examData = [
        ':title' => $title,
        ':course_name' => $course_name,
        ':teacher_id' => $_SESSION['user_id'],
        ':pass_score' => $pass_score
      ];

      $examId = $this->examModel->createExam($examData);

      if (!$examId) {
        throw new Exception('خطا در ذخیره آزمون');
      }

      foreach ($questions as $index => $q) {
        $questionData = [
          ':exam_id' => $examId,
          ':question_text' => $q['text'],
          ':question_type' => $q['type'],
          ':code_block' => $q['code_block'] ?? null,
          ':score' => intval($q['score']),
          ':options' => isset($q['options']) ? json_encode($q['options']) : null,
          ':correct_answer' => $q['correct_answer'],
          ':sort_order' => $index
        ];
        $this->examModel->createQuestion($questionData);
      }

      $_SESSION['exam_success'] = 'امتحان <strong>' . htmlspecialchars($title) . '</strong> با موفقیت آپلود شد.';
    } catch (PDOException $e) {
      $_SESSION['exam_error'] = 'خطای دیتابیس: ' . $e->getMessage();
    } catch (Exception $e) {
      $_SESSION['exam_error'] = $e->getMessage();
    }

    redirect('/panel/quests');
  }

  // Delete exam
  public function delete($id)
  {
    $this->checkTeacherAuth();

    try {
      $exam = $this->examModel->getExamById($id);

      if ($this->examModel->deleteExam($id, $_SESSION['user_id'])) {
        $_SESSION['exam_success'] = 'امتحان <strong>' . htmlspecialchars($exam['title']) . '</strong> با موفقیت حذف شد.';
      } else {
        $_SESSION['exam_error'] = 'خطا در حذف آزمون.';
      }
    } catch (PDOException $e) {
      $_SESSION['exam_error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/quests');
  }

  // Display exam lists in certificates page
  public function certificates()
  {
    $exams = $this->examModel->getAllExams();
    require_once '../app/Views/pages/certificates.php';
  }

  // Display take exam
  public function takeExam($id)
  {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
      redirect('/login');
    }

    if ($_SESSION['role'] !== 'student') {
      // $_SESSION['exam_error'] = 'فقط دانشجویان می‌توانند در آزمون شرکت کنند.';
      redirect('/certificates');
    }

    $exam = $this->examModel->getExamById($id);
    if (!$exam) {
      http_response_code(404);
      require_once '../app/Views/errors/404.php';
      return;
    }

    $existingResult = $this->examModel->getExistingPassedResult($id, $_SESSION['user_id']);

    if ($existingResult) {
      redirect('/certificates/view/' . $existingResult['id']);
    }

    $questions = $this->examModel->getExamQuestions($id);
    require_once '../app/Views/pages/certificate-test.php';
  }

  // Submit exam
  public function submitExam()
  {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
      redirect('/auth/login');
    }

    $examId = intval($_POST['exam_id'] ?? 0);
    $answers = $_POST['answers'] ?? [];

    // $_SESSION['debug_info'] = [
    //   'exam_id' => $examId,
    //   'answers_count' => count($answers),
    //   'post_data' => $_POST,
    //   'time' => date('Y-m-d H:i:s')
    // ];

    if (!$examId) {
      $_SESSION['exam_error'] = 'آزمون یافت نشد.';
      redirect('/certificates');
    }

    $exam = $this->examModel->getExamById($examId);
    if (!$exam) {
      $_SESSION['exam_error'] = 'آزمون یافت نشد.';
      redirect('/certificates');
    }

    if ($this->examModel->hasStudentTakenExam($examId, $_SESSION['user_id'])) {
      // $_SESSION['exam_error'] = 'شما قبلاً در این آزمون شرکت کرده‌اید.';
      redirect('/certificates');
    }

    $questions = $this->examModel->getExamQuestions($examId);
    $totalScore = 0;
    $studentScore = 0;

    // $_SESSION['debug_info']['questions_count'] = count($questions);

    foreach ($questions as $question) {
      $totalScore += $question['score'];
      $userAnswer = $answers[$question['id']] ?? '';
      $isCorrect = $this->checkAnswer($question, $userAnswer);

      if ($isCorrect) {
        $studentScore += $question['score'];
      }
    }

    $percentage = ($totalScore > 0) ? round(($studentScore / $totalScore) * 100) : 0;
    $isPassed = $percentage >= $exam['pass_score'];
    $certificateCode = $isPassed ? $this->examModel->generateUniqueCode() : null;

    // $_SESSION['debug_info']['total_score'] = $totalScore;
    // $_SESSION['debug_info']['student_score'] = $studentScore;
    // $_SESSION['debug_info']['percentage'] = $percentage;
    // $_SESSION['debug_info']['is_passed'] = $isPassed;

    try {
      $resultData = [
        ':exam_id' => $examId,
        ':student_id' => $_SESSION['user_id'],
        ':score' => $studentScore,
        ':total_score' => $totalScore,
        ':percentage' => $percentage,
        ':is_passed' => $isPassed ? 1 : 0,
        ':certificate_code' => $certificateCode
      ];

      $resultId = $this->examModel->saveResult($resultData);
      $_SESSION['debug_info']['result_id'] = $resultId;

      if (!$resultId) {
        throw new Exception('خطا در ذخیره نتیجه آزمون - result_id is false');
      }

      foreach ($questions as $question) {
        $userAnswer = $answers[$question['id']] ?? '';
        $isCorrect = $this->checkAnswer($question, $userAnswer);

        $answerData = [
          ':result_id' => $resultId,
          ':question_id' => $question['id'],
          ':answer' => $userAnswer,
          ':is_correct' => $isCorrect ? 1 : 0
        ];
        $this->examModel->saveAnswer($answerData);
      }

      if (!$isPassed) {
        $_SESSION['exam_error'] = "نمره شما {$percentage}% است. حداقل نمره قبولی {$exam['pass_score']}% می‌باشد. متأسفانه قبول نشدید.";
        redirect('/certificates');
      }

      $_SESSION['exam_result'] = [
        'score' => $studentScore,
        'total_score' => $totalScore,
        'percentage' => $percentage,
        'is_passed' => $isPassed,
        'certificate_code' => $certificateCode,
        'exam_title' => $exam['title'],
        'course_name' => $exam['course_name'],
        'teacher_name' => $exam['teacher_name'],
        'pass_score' => $exam['pass_score'],
        'student_name' => $_SESSION['full_name'],
        'completed_at' => date('Y-m-d H:i:s')
      ];

      // error_log('exam_result session set: ' . json_encode($_SESSION['exam_result']));
      // error_log('Headers sent? ' . (headers_sent() ? 'YES' : 'NO'));

      redirect('/certificates/result');
    } catch (PDOException $e) {
      $_SESSION['exam_error'] = 'خطای دیتابیس: ' . $e->getMessage();
      redirect('/certificates');
    } catch (Exception $e) {
      $_SESSION['exam_error'] = $e->getMessage();
      redirect('/certificates');
    }
  }

  // Display exam result 
  public function showResult()
  {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
      redirect('/login');
    }

    $result = $_SESSION['exam_result'] ?? null;
    if (!$result) {
      redirect('/certificates');
    }

    unset($_SESSION['exam_result']);
    require_once '../app/Views/pages/certificate-view.php';
  }

  // Verify certificate
  public function verifyCertificate()
  {
    $code = trim($_GET['code'] ?? '');
    $certificate = null;
    $error = null;

    if (!empty($code)) {
      $certificate = $this->examModel->getCertificateByCode($code);
      if (!$certificate) {
        $error = 'کد یکتا ورودی نادرست است یا اشتباه وارد شده.';
      }
    }

    $exams = $this->examModel->getAllExams();
    require_once '../app/Views/pages/certificates.php';
  }

  // Get certificates for student panel
  public function myCertificates()
  {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
      redirect('/');
    }

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 12;
    $offset = ($page - 1) * $perPage;

    $certificates = $this->examModel->getStudentCertificatesPaginated($_SESSION['user_id'], $perPage, $offset);
    $totalCertificates = $this->examModel->getStudentCertificatesCount($_SESSION['user_id']);
    $totalPages = ceil($totalCertificates / $perPage);

    require_once '../app/Views/dashboard/student/certificates.php';
  }

  /// Display certificate for student panel
  public function viewCertificate($id)
  {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
      redirect('/login');
    }

    $certificate = $this->examModel->getCertificateById($id, $_SESSION['user_id']);

    if (!$certificate) {
      redirect('/panel/certificates');
    }

    $result = [
      'student_name' => $certificate['student_name'],
      'course_name' => $certificate['course_name'],
      'teacher_name' => $certificate['teacher_name'],
      'percentage' => $certificate['percentage'],
      'score' => $certificate['score'],
      'total_score' => $certificate['total_score'],
      'certificate_code' => $certificate['certificate_code'],
      'completed_at' => $certificate['completed_at'],
      'is_passed' => true
    ];

    require_once '../app/Views/pages/certificate-view.php';
  }

  // Check answer
  private function checkAnswer($question, $userAnswer)
  {
    $correctAnswer = $question['correct_answer'];
    $questionType = $question['question_type'];

    switch ($questionType) {
      case 'truefalse':
      case 'multiple':
      case 'codeoutput':
        return $userAnswer === $correctAnswer;
      default:
        return false;
    }
  }

  // Get exams list
  public function getExamsList()
  {
    header('Content-Type: application/json');

    $this->checkTeacherAuth();

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 12;
    $offset = ($page - 1) * $perPage;

    $exams = $this->examModel->getExamsByTeacher($_SESSION['user_id'], $perPage, $offset);
    $totalExams = $this->examModel->getExamsCountByTeacher($_SESSION['user_id']);
    $totalPages = ceil($totalExams / $perPage);

    // Format data for JSON response
    $formattedExams = [];
    foreach ($exams as $exam) {
      $formattedExams[] = [
        'id' => $exam['id'],
        'title' => $exam['title'],
        'teacher_name' => $_SESSION['full_name'] ?? 'استاد',
        'created_at_fa' => toJalali($exam['created_at'], 'Y/m/d'),
        'created_at' => $exam['created_at']
      ];
    }

    echo json_encode([
      'success' => true,
      'exams' => $formattedExams,
      'page' => $page,
      'totalPages' => $totalPages,
      'totalExams' => $totalExams
    ]);
  }

  // Get certificates list for AJAX pagination
  public function getCertificatesList()
  {
    header('Content-Type: application/json');

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
      echo json_encode(['success' => false, 'message' => 'Unauthorized']);
      return;
    }

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 12;
    $offset = ($page - 1) * $perPage;

    $items = $this->examModel->getStudentCertificatesPaginated($_SESSION['user_id'], $perPage, $offset);
    $totalItems = $this->examModel->getStudentCertificatesCount($_SESSION['user_id']);
    $totalPages = ceil($totalItems / $perPage);

    $formattedItems = [];
    foreach ($items as $item) {
      $formattedItems[] = [
        'id' => $item['id'],
        'exam_title' => $item['exam_title'],
        'percentage' => $item['percentage'],
        'completed_at_fa' => toJalali($item['completed_at'], 'Y/m/d'),
      ];
    }

    echo json_encode([
      'success' => true,
      'items' => $formattedItems,
      'page' => $page,
      'totalPages' => $totalPages,
      'totalItems' => $totalItems
    ]);
  }

  private function checkTeacherAuth()
  {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
      show403();
    }
  }
}
