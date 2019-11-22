<!-- SCRIPT INI DIBUAT OLEH FENDI RIDHO FERDIANSYAH (2019) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hasil Perhitungan</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        table{
          width: 55%;
        }
        td.c {
            width: 15%;
        }
        table.xy{
            width: 15%;
        }
        th, td {
            padding: 5px;
        }
        th.kiri{
            width: 5%;
        }
      </style>
</head>
<body>
    <?php
    if (empty($_POST["ax"])){
       $_POST["errorax"] = "Masukkan Nilai!";
    }
    // INISIALISASI I 
    $sat = "";
    $zero = 0;
    $ax = $_POST["ax"];
    $ay = $_POST["ay"];
    $az = $_POST["az"];
    $bx = $_POST["bx"];
    $by = $_POST["by"];
    $bz = $_POST["bz"];
    $cx = $_POST["cx"];
    $cy = $_POST["cy"];

    // INISIALISASI II
    $y1 = $az/$ay;
    $x1 = $az/$ax;
    $y2 = $bz/$by;
    $x2 = $bz/$bx;
    $abx = $ax*$by;
    $aby = $ay*$by;
    $abz = $az*$by;
    $bax = $bx*$ay;
    $bay = $by*$ay;
    $baz = $bz*$ay;
    $resx = $abx-$bax;
    $resz = $abz-$baz;
    $res = abs($resx)."x = ".abs($resz);
    $finresx = $resz/$resx;
    $resfinres = $finresx*$ax;
    $zx = $az - $resfinres;
    $finresy = $zx/$ay;
    $fo = "F(x,y) = ".$cx."x + ".$cy."y";

    // LOGIKA MIN & MAX
    if($_POST["sat"] == "min"){
        // JIkA MINIMUM
        //BASIC
        $sat = "≥";
        $ket = "(salah)";
        $tit = "B";
        $opt = "(min)";
        $da = "";
        //PENENTUAN TITIK
        $maxx = max($x1, $x2);
        $maxy = max($y1, $y2);
        $a = "(".$maxx.",".$zero.")";
        $b = "(".$finresx.",".$zx/$ay.")";
        $c = "(".$zero.",".$maxy.")";
        // FUNGSI OBJEKTIF
        $resa = $cx*$maxx + $cy * $zero;
        $resb = $cx*$finresx + $cy * $zx/$ay;
        $resc = $cx*$zero + $cy*$maxy;
        $ril = min($resa, $resb, $resc)." (min)";
        $fa = $cx."(".$maxx.") + ".$cy."(".$zero.") = ".$resa;
        $fb = $cx."(".$finresx.") + ".$cy."(".$zx/$ay.") = ".$resb;
        $fc = $cx."(".$zero.") + ".$cy."(".$maxy.") = ".$resc;
        // TABEL D YANG KOSONG
        $fd = "";
        $d = "";
    }
    else{
        // JIKA MAX
        // BASIC
        $sat = "≤";
        $ket = "(benar)";
        $tit = "C";
        $opt = "(max)";
        // PENENTUAN TITIK
        $a = "(".$zero.",".$zero.")";
        $minx = min($x1, $x2);
        $miny = min($y1, $y2);
        $b = "(".$minx.",".$zero.")";
        $c = "(".$finresx.",".$zx/$ay.")";
        $d = "(".$zero.",".$miny.")";
        // FUNGSI OBJEKTIF
        $resb = $cx*$minx + $cy * $zero;
        $resc = $cx*$finresx + $cy * $zx/$ay;
        $resd = $cx*$zero + $cy*$miny;
        $ril = max(0, $resb, $resc, $resd)." (max)";
        $fa = $cx."(".$zero.") + ".$cy."(".$zero.") = 0";
        $fb = $cx."(".$minx.") + ".$cy."(".$zero.") = ".$resb;
        $fc = $cx."(".$finresx.") + ".$cy."(".$zx/$ay.") = ".$resc;
        // TABEL D TERISI
        $fd = $cx."(".$zero.") + ".$cy."(".$miny.") = ".$resd;
        $da = "D";
    }

    // INISIALISASI III
    $mm = $ax."x + ".$ay."y"." ".$sat." ".$az;
    $mmx = $ax."x + ".$ay."y"." = ".$az;
    $mmy = $abx."x + ".$aby."y"." = ".$abz;
    $mm2 = $bx."x + ".$by."y"." ".$sat." ".$bz;
    $mm2x = $bx."x + ".$by."y"." = ".$bz;
    $mm2y = $bax."x + ".$bay."y"." = ".$baz;

    // TAMPILAN HASIL
    if($_POST["alx"] && $_POST["aly"] != ""){
        echo "Misal ".$_POST["alx"]." = x; ".$_POST["aly"]." = y";
    }
    // MODEL MATEMATIKA
    echo "<h3>MODEL MATEMATIKA</h3><br>";
    echo "(i)".$mm;
    echo "<br>";
    echo "(ii)".$mm2;
    echo "<br>";
    echo "(iii)x ≥ 0";
    echo "<br>";
    echo "(iv)y ≥ 0";
    echo "<br>";

    // FUNGSI OBJEKTIF
    echo "<h3>FUNGSI OBJEKTIF</h3><br>";
    echo $fo; 
    echo "<br>";
    echo $mmx;
    ?>
    <!-- TABLE I -->
    <table class="xy">
        <tr>
            <th>X</th>
            <td>0</td>
            <td><?php echo $x1; ?></td>
        </tr>
        <tr>
            <th>Y</th>
            <td><?php echo $y1; ?></td>
            <td>0</td>
        </tr>
    </table>
    <?php 
    echo $mm2x;
    ?>
    <!-- TABLE II -->
    <table class="xy">
        <tr>
            <th>X</th>
            <td>0</td>
            <td><?php echo $x2; ?></td>
        </tr>
        <tr>
            <th>Y</th>
            <td><?php echo $y2; ?></td>
            <td>0</td>
        </tr>
    </table>
    <?php

    // TITIK UJI
    echo "titik uji (0,0) :<br>";
    echo $mm;
    echo "<br>";
    echo "0 ".$sat." ".$az.$ket;
    echo "<br>";
    echo $mm2;
    echo "<br>";
    echo "0 ".$sat." ".$bz.$ket;
    echo "<br>";

    // PENCARIAN TITIK
    echo "<h3>Mencari titik ".$tit."</h3><br>";
    echo $mmx."|*".$by."|";
    echo $mmy;
    echo "<br>";
    echo $mm2x."|*".$ay."|";
    echo $mm2y;
    echo "<br>";
    echo $res;
    echo "<br>";
    echo "x = ".abs($resz)."/".abs($resx);
    echo "<br>";
    echo "x = ".$finresx;
    echo "<br>";
    echo "=====================================================<br>";
    echo $mmx;
    echo "<br>";
    echo $ax."(".$finresx.") + ".$ay."y = ".$az;
    echo "<br>";
    echo $resfinres." + ".$ay."y"." = ".$az;
    echo "<br>";
    echo $ay."y = ".$zx;
    echo "<br>";
    echo "y = ".$zx."/".$ay;
    echo "<br>";  
    echo "y = ".$finresy;  

    //  NILAI OPTIMUM
    echo "<br><h3>NILAI OPTIMUM".$opt."<h3><br>";
    ?>
    <table>
        <tr>
            <th class="kiri">Titik</th>
            <th>Koordinat</th>
            <th class="panjang"><?php echo $fo;?></th>
        </tr>
        <tr>
            <th class="kiri">A</th>
            <td class="c"><?php echo $a;?></td>
            <td class="panjang"><?php echo $fa;?></td>
        </tr>
        <tr>
            <th class="kiri">B</th>
            <td class="c"><?php echo $b;?></td>
            <td class="panjang"><?php echo $fb;?></td>
        </tr>
        <tr>
            <th class="kiri">C</th>
            <td class="c"><?php echo $c;?></td>
            <td class="panjang"><?php echo $fc;?></td>
        </tr>
        <tr>
            <th class="kiri"><?php echo $da;?></th>
            <td class="c"><?php echo $d;?></td>
            <td class="panjang"><?php echo $fd;?></td>
        </tr>
    </table>
    <?php echo $ril;?>
    <a href="index.html"><button>Ulangi</button></a>
</body>
</html>
