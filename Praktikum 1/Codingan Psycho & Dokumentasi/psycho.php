<?php
// psycho.php
// Program untuk mencari 2 angka selanjutnya dari tiga deret psyko

function next_two_a($arr) {
    // pola: selisih bertambah 1 setiap langkah (aritmetika kedua)
    $diffs = [];
    for ($i = 1; $i < count($arr); $i++) {
        $diffs[] = $arr[$i] - $arr[$i-1];
    }
    $lastDiff = end($diffs);
    $next1 = end($arr) + ($lastDiff + 1);
    $next2 = $next1 + ($lastDiff + 2);
    return [$next1, $next2];
}

function next_two_b($arr) {
    // pola: setiap angka muncul dua kali, kemudian naik 1
    $n = count($arr);
    $last = $arr[$n-1];
    $prev = ($n >= 2) ? $arr[$n-2] : null;

    if ($prev === $last) {
        // sudah ada pasangan lengkap terakhir, jadi naik 1
        $next1 = $last + 1;
        $next2 = $last + 1;
    } else {
        // pasangan terakhir belum lengkap -> ulangi last, lalu naik 1
        $next1 = $last;
        $next2 = $last + 1;
    }
    return [$next1, $next2];
}

function next_two_c($arr) {
    // pola: posisi ganjil = 1,2,3,... ; posisi genap = 9,10,11,...
    // kita generate dua elemen berikut menggunakan formula posisi
    $n = count($arr);
    $next = [];
    for ($k = 1; $k <= 2; $k++) {
        $pos = $n + $k; // 1-based posisi
        if ($pos % 2 == 1) {
            // ganjil -> sequential mulai 1
            $val = intdiv($pos - 1, 2) + 1;
        } else {
            // genap -> mulai 9
            $val = 8 + intdiv($pos, 2);
        }
        $next[] = $val;
    }
    return $next;
}

// input deret dari soal
$a = [4, 6, 9, 13, 18];
$b = [2, 2, 3, 3, 4];
$c = [1, 9, 2, 10, 3];

// hitung
$a_next = next_two_a($a);
$b_next = next_two_b($b);
$c_next = next_two_c($c);

// tampilkan hasil
echo "Soal (a): " . implode(' ', $a) . " -> Selanjutnya: " . implode(' ', $a_next) . PHP_EOL, "<br>";
echo "Soal (b): " . implode(' ', $b) . " -> Selanjutnya: " . implode(' ', $b_next) . PHP_EOL, "<br>";
echo "Soal (c): " . implode(' ', $c) . " -> Selanjutnya: " . implode(' ', $c_next) . PHP_EOL, "<br>";

// Penjelasan singkat pola:
echo PHP_EOL . "Penjelasan pola:" . PHP_EOL,"<br>";
echo "a) Selisih bertambah: 4->6(+2),6->9(+3),9->13(+4),13->18(+5) => next diffs +6 dan +7 -> 24, 31" . PHP_EOL, "<br>";
echo "b) Setiap angka muncul dua kali lalu naik 1: 2,2,3,3,4 -> maka 4,5" . PHP_EOL, "<br>";
echo "c) Bergantian: posisi ganjil = 1,2,3,... ; posisi genap = 9,10,11,... => setelah 1,9,2,10,3 -> 11,4" . PHP_EOL;