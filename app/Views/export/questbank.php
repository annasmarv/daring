<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="icon" type="image/png" href="<?= base_url(); ?>/assets/images/<?= web()->favicon; ?>">
    <style type='text/css'>
        *{
            padding: 0;
            margin: 0;
            font-family: Arial, Georgia, serif!important;
        }
        td p{
            display: inline-block;
            margin: 0!important;
            text-indent: 0!important;
        }
        td p span{
            display: inline;
        }
        div p{
            display: inline-block!important;
        }
        @page { margin: 1cm 2cm; }
        body { margin: 1cm 2cm; }
    </style>
</head>
<body>
    <div class="wrapper">
        <table style="margin-left: auto;margin-right: auto;">
            <?php foreach ($banks as $bank): ?>
                <tr>
                    <td>Mata Pelajaran</td><td>:</td><td><?= $bank['subject_name']; ?></td>
                </tr>
                <tr>
                    <td>Kode Soal</td><td>:</td><td><?= $bank['quest_code']; ?></td>
                </tr>
                <tr>
                    <td width="100">Guru</td><td width="10">:</td><td><?= $bank['fullname']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <table>
            <br>
            <tr>
                <td colspan="2" align="center" style="background-color: grey;"><strong>Daftar Soal</strong></td>
            </tr>
            <br>
            <?php foreach ($quests as $quest): ?>
            <tr valign="top">
                <td width="20"><?= $quest['number']; ?>.</td>
                <td>
                    <?= $quest['question']; ?><br>
                    <?php if ($quest['type'] == 1): ?>
                        A. <?= $quest['answer1']; ?><br>
                        B. <?= $quest['answer2']; ?><br>
                        C. <?= $quest['answer3']; ?><br>
                        D. <?= $quest['answer4']; ?><br>
                        <?php if ($quest['quest_option']==5): ?>
                        E. <?= $quest['answer5']; ?><br>
                        <?php endif ?>
                    <?php endif ?>
                </td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>