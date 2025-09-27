<?php
// تحديد نوع المحتوى ليكون JSON
header('Content-Type: application/json');

// التأكد من أن الكود تم إرساله
if (!isset($_GET['code'])) {
    echo json_encode(['error' => 'No code provided']);
    exit();
}

$student_code = $_GET['code'];
$json_file = 'results.json';

// التأكد من وجود ملف النتائج
if (!file_exists($json_file)) {
    echo json_encode(['error' => 'Results file not found']);
    exit();
}

// قراءة محتوى ملف JSON
$json_data = file_get_contents($json_file);
$students = json_decode($json_data, true);

$found_student = null;

// البحث عن الطالب باستخدام الكود
foreach ($students as $student) {
    if ($student['code'] == $student_code) {
        $found_student = $student;
        break;
    }
}

// إرجاع بيانات الطالب إذا تم العثور عليه، أو رسالة خطأ
if ($found_student) {
    echo json_encode($found_student);
} else {
    echo json_encode(['error' => 'Student not found']);
}
?>