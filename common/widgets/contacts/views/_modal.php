<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<div class="modal fade" id="contactWidgetForm" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Создание контакта</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="contacts-table" style="width: 100%">
                    <tr>
                        <th>ФИО</th>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control" >
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Должность</th>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Телефоны
                            <div>
                                <a href="#" class="badge badge-primary contact-phone-create-field-o">
                                    <i class="bi bi-plus"></i>
                                </a>
                            </div>
                        </th>
                        <td class="dynamic-contact-lines">
                            <div class="form-group contact-phone-list-o">
                                <?php for($i = 0; $i < 4; $i++) : ?>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <input type="text" class="form-control phone-mask">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" placeholder="Доб.">
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            E-mails
                            <div>
                                <a href="#" class="badge badge-primary contact-email-create-field-o">
                                    <i class="bi bi-plus"></i>
                                </a>
                            </div>
                        </th>
                        <td class="dynamic-contact-lines">
                            <div class="form-group contact-email-list-o">
                                <?php for($i = 0; $i < 4; $i++) : ?>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <input type="email" class="form-control">
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Комментарий
                        </th>
                        <td>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <textarea class="form-control" cols="2" rows="2"></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-success btn-submit-contact-form-o btn-disabled" disabled="disabled">Сохранить</button>
            </div>
        </div>
    </div>
</div>



