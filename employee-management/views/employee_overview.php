<?php 
/**
 * TUGAS
 * FILE: views/employee_overview.php
 * FUNGSI: Menampilkan total karyawan, total gaji per bulan, dan rata-rata masa kerja
 */
include 'views/header.php';

$query = "
    SELECT 
        COUNT(*) AS total_employees,
        SUM(salary) AS total_salary,
        ROUND(AVG(EXTRACT(YEAR FROM AGE(CURRENT_DATE, hire_date))), 2) AS avg_years
    FROM employees;
";
$row = $db->query($query)->fetch(PDO::FETCH_ASSOC);
?>

<h2>Ringkasan Karyawan</h2>
<p>Menampilkan total karyawan, total gaji, dan rata-rata masa kerja.</p>

<div class="dashboard-cards">
    <div class="card">
        <h3>Total Karyawan</h3>
        <div class="number"><?php echo $row['total_employees']; ?></div>
    </div>
    <div class="card">
        <h3>Total Gaji per Bulan</h3>
        <div class="number">Rp <?php echo number_format($row['total_salary'], 0, ',', '.'); ?></div>
    </div>
    <div class="card">
        <h3>Rata-rata Masa Kerja</h3>
        <div class="number"><?php echo $row['avg_years']; ?> tahun</div>
    </div>
</div>

<?php include 'views/footer.php'; ?>
