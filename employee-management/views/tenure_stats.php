<?php 
/**
 * TUGAS
 * FILE: views/tenure_stats.php
 * FUNGSI: Menampilkan jumlah karyawan berdasarkan masa kerja (Junior, Middle, Senior)
 */
include 'views/header.php';

$query = "
    SELECT 
        CASE 
            WHEN EXTRACT(YEAR FROM AGE(CURRENT_DATE, hire_date)) < 1 THEN 'Junior'
            WHEN EXTRACT(YEAR FROM AGE(CURRENT_DATE, hire_date)) BETWEEN 1 AND 3 THEN 'Middle'
            ELSE 'Senior'
        END AS level,
        COUNT(*) AS total
    FROM employees
    GROUP BY level
    ORDER BY level;
";
$result = $db->query($query);
?>

<h2>Statistik Masa Kerja Karyawan</h2>
<p>Menampilkan jumlah karyawan berdasarkan tingkat masa kerja:</p>
<ul>
    <li>Junior: &lt; 1 tahun</li>
    <li>Middle: 1–3 tahun</li>
    <li>Senior: &gt; 3 tahun</li>
</ul>

<table class="data-table">
    <thead>
        <tr>
            <th>Kategori</th>
            <th>Jumlah Karyawan</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><strong><?php echo $row['level']; ?></strong></td>
            <td><?php echo $row['total']; ?> orang</td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'views/footer.php'; ?>
