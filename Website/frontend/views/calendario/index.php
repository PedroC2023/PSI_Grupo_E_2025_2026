<?php
use yii\helpers\Html;
?>

<div style="width:300px; position:relative;">

    <h1 style="margin:0;">
        Calendário
    </h1>

    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->can('manageEvents')): ?>
        <?= Html::a(
                '+',
                ['evento/create'],
                [
                        'class' => 'btn btn-primary',
                        'title' => 'Criar Evento',
                        'style' => '
                    position:absolute;
                    top:0;
                    right:0;
                    width:32px;
                    height:32px;
                    padding:0;
                    line-height:30px;
                    text-align:center;
                    font-size:20px;
                    font-weight:bold;
                    border-radius:50%;
                '
                ]
        ) ?>
    <?php endif; ?>

    <table class="table table-bordered"
           style="width:300px;text-align:center;margin-top:15px;">
        <tr>
            <th>Dom</th><th>Seg</th><th>Ter</th>
            <th>Qua</th><th>Qui</th><th>Sex</th><th>Sáb</th>
        </tr>

        <?php
        $month = date('m');
        $year = date('Y');
        $firstDay = date('w', strtotime("$year-$month-01"));
        $daysInMonth = date('t');

        echo "<tr>";
        for ($i = 0; $i < $firstDay; $i++) echo "<td></td>";
        $day = 1;

        while ($day <= $daysInMonth) {
            if ($i % 7 == 0 && $i != 0) echo "</tr><tr>";

            $eventoEncontrado = null;
            foreach ($eventos as $evento) {
                if (date('j', strtotime($evento->data_inicio)) == $day) {
                    $eventoEncontrado = $evento;
                    break;
                }
            }

            echo "<td>$day";

            if ($eventoEncontrado) {
                echo "<br>" . Html::a(
                                'Evento',
                                ['calendario/view', 'id' => $eventoEncontrado->id],
                                ['class' => 'badge bg-primary']
                        );
            }

            echo "</td>";
            $day++; $i++;
        }

        while ($i % 7 != 0) {
            echo "<td></td>";
            $i++;
        }
        echo "</tr>";
        ?>
    </table>

</div>
