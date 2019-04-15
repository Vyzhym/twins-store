<!-- Навигация -->
<ul class="nav nav-tabs" role="tablist" style="margin-bottom:30px">
    <li class="active"><a href="#main" aria-controls="posts" role="tab" data-toggle="tab">Основное</a></li>
    <!--<li><a href="#dev" aria-controls="requests" role="tab" data-toggle="tab">Для разроботчика</a></li>-->
</ul>
<!-- Содержимое вкладок -->




    <div class="col-md-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <div class="box-title"></div>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">

                        <ul class="timeline">

                            <!-- timeline time label -->
                            <li class="time-label">
							        <span class="bg-green">
							            Заказ № {{$order->id}}
							        </span>



                            </li>
                            <!-- /.timeline-label -->


                            <li>
                                <!-- timeline icon -->
                               <i class="fa fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">

                                    </h3>
                                </div>
                            </li>





                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-user bg-blue"></i>
                                <div class="timeline-item row">
                                    <div class="col-sm-3">Коментарий к заказу:</div>
                                    <div class="col-sm-9">{{$order->comment}}</div>
                                </div>
                            </li>

                        </ul>





                        <table>



                        </table>


                    </div>
                    <div class="col-md-4">
                        <table>
                            <tr>
                                <td>Имя: </td>
                                <td><b>{{$order->name}}</b></td>
                            </tr>
                            <tr>
                                <td>Фамилия: </td>
                                <td><b>{{$order->lname}}</b></td>
                            </tr>
                            <tr>
                                <td>Телефон: </td>
                                <td><b>{{$order->phone}}</b></td>
                            </tr>
                            <tr>
                                <td>Email: </td>
                                <td><b>{{$order->email}}</b></td>
                            </tr>
                            <tr>
                                <td>Тип доставки: </td>
                                <td><b>{{$order->shipping}}</b></td>
                            </tr>
                            <tr>
                                <td>Город: </td>
                                <td><b>{{$order->shipping_form_city}}</b></td>
                            </tr>
                            <tr>
                                <td>№ отделения: </td>
                                <td><b>{{$order->shipping_form_target}}</b></td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




<div class="tab-content">

    <div role="tabpanel" class="tab-pane active" id="main">
        <form method="POST" action="/admin/settings/clear">
            <button class="btn btn-danger" type="submit">Удалить кеш</button>
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
        </form>
    </div>
    <?php /*<div role="tabpanel" class="tab-pane" id="dev">
        <i>Все пользовательские контроллеры в backend или же контроллеры от которых они наследуются - должны <b>обязательно</b>
        <br/>наследоваться от AppController или его наследников(<span style="color:red">Ничего не должно наследоваться от Controller!</span>)</i>
        <!-- Навигация -->
        <ul class="nav nav-tabs" role="tablist" style="margin-bottom:30px">
            <li class="active"><a href="#danger" aria-controls="posts" role="tab" data-toggle="tab">Danger</a></li>
            <li><a href="#warning" aria-controls="requests" role="tab" data-toggle="tab">Warning</a></li>
            <li><a href="#success" aria-controls="requests" role="tab" data-toggle="tab">Normal</a></li>
        </ul>
        <!-- Содержимое вкладок -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" style="color:#181b8e" id="danger">
                <?php
                if(empty($arScan['danger'])){
                    echo "<span class='text-success'>Опасных контроллеров не найдено</span>";
                }else {
                    echo "<span class='text-danger'><i>Данные контроллеры не должны наследоваться от Controller, их следует немедленно исправить</i></span><br/><br/>";
                    $i=1;
                    foreach ($arScan['danger'] as $item):
                        echo "{$i}. {$item['name']} <span style='color:#a953eb'>extends</span> <b style='color:#fc0b06'>{$item['extends']}</b><br/>";
                    $i++;
                    endforeach;
                }
                ?>
            </div>
            <div role="tabpanel" class="tab-pane" style="color:#181b8e" id="warning">
                <?php
                if(empty($arScan['warning'])){
                    echo "<span class='text-success'>Подозрительных контроллеров не найдено</span>";
                }else {
                    echo "<span class='text-danger'><i>Данные контроллеры нуждаются в ручной проверке наслудемых классов</i></span><br/><br/>";
                    $i=1;
                    foreach($arScan['warning'] as $item):
                        echo "{$i}. {$item['name']} <span style='color:#a953eb'>extends</span> <b style='color:#FF9800'>{$item['extends']}</b><br/>";
                        $i++;
                    endforeach;
                ?}?>
            </div>
            <div role="tabpanel" class="tab-pane" style="color:#181b8e"  id="success">
                <?php
                if(empty($arScan['normal'])){
                    echo "<span class='text-danger'>Нормальных контроллеров не найдено</span>";
                }else {
                    $i=1;
                    foreach($arScan['normal'] as $item):
                        echo "{$i}. {$item['name']} <span style='color:#a953eb'>extends</span> <b style='color:#0ed311'>{$item['extends']}</b><br/>";
                        $i++;
                    endforeach;
                }?>
            </div>
        </div>
    </div>*/?>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        if(window.location.hash == '#dev'){
            $('.nav-tabs li,.tab-pane').removeClass('active');
            $('a[href="#dev"], a[href="#danger"]').parent().addClass('active');
            $('#dev, #danger').addClass('active');
        }
    });
</script>
