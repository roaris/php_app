<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>
        <h2><?= $message ?></h2>
        <form action='youbi_result.php' method='get'>
            <select name='year'><?php for ($i=1900; $i<2100; $i++) { ?><option><?=$i?></option><?php } ?></select>年
            <select name='month'><?php for ($i=1; $i<=12; $i++) { ?><option><?=$i?></option><?php } ?></select>月
            <select name='day'><?php for ($i=1; $i<=31; $i++) { ?><option><?=$i?></option><?php } ?></select>日
            <p></p>
            <button type='submit'>計算</button>
            <p></p>
            <a href='index.php'>トップに戻る</a>
        </form>
    </body>
</html>