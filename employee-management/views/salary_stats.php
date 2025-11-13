<?php 
/** 
 * TUGAS
 * FILE: views/salary_stats.php
 * FUNGSI: Menampilkan rata-rata, gaji tertinggi, dan gaji terendah per departemen
 */
include 'views/header.php'; 

$query = "
    SELECT department,
           ROUND(AVG(salary)) AS avg_salary,
           MAX(salary) AS max_salary,
           MIN(salary) AS min_salary
    FROM employees
    GROUP BY department
    ORDER BY department;
";
$result = $db->query($query);
?>

<h2>Statistik Gaji per Departemen</h2>
<p>Menampilkan rata-rata, gaji tertinggi, dan gaji terendah untuk setiap departemen.</p>

<table class="data-table">
    <thead>
        <tr>
            <th>Departemen</th>
            <th>Gaji Rata-rata</th>
            <th>Gaji Tertinggi</th>
            <th>Gaji Terendah</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><strong><?php echo htmlspecialchars($row['department']); ?></strong></td>
            <td>Rp <?php echo number_format($row['avg_salary'], 0, ',', '.'); ?></td>
            <td>Rp <?php echo number_format($row['max_salary'], 0, ',', '.'); ?></td>
            <td>Rp <?php echo number_format($row['min_salary'], 0, ',', '.'); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'views/footer.php'; ?>
