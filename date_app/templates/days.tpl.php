<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <h2><?= $message ?></h2>
        <form action='days_result.php' method='get'>
            開始日
            <select name='year1'><?php for ($i=1900; $i<2100; $i++) { ?><option><?=$i?></option><?php } ?></select>年
            <select name='month1'><?php for ($i=1; $i<=12; $i++) { ?><option><?=$i?></option><?php } ?></select>月
            <select name='day1'><?php for ($i=1; $i<=31; $i++) { ?><option><?=$i?></option><?php } ?></select>日
            <p></p>
            終了日
            <select name='year2'><?php for ($i=1900; $i<2100; $i++) { ?><option><?=$i?></option><?php } ?></select>年
            <select name='month2'><?php for ($i=1; $i<=12; $i++) { ?><option><?= $i ?></option><?php } ?></select>月
            <select name='day2'><?php for ($i=1; $i<=31; $i++) { ?><option><?= $i ?></option><?php } ?></select>日
            <p></p>
            <button type='submit'>計算</button>
            <p></p>
            <a href='index.php'>トップに戻る</a>
        </form>
</html>