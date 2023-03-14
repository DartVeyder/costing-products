<?php 

$content = '
<h3>Продукція</h3>
<!-- Button trigger modal -->
<div class="col-3">
    <button type="button" class="btn btn-primary mt-3 mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Додати
    </button>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Додати нову продукцію</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="sku" class="form-label">Артикул</label>
                        <input type="text" class="form-control" id="sku" required> 
                    </div> 
                    <div class="mb-3">
                        <label for="name" class="form-label">Назва</label>
                        <input type="text" class="form-control" id="name" required> 
                    </div> 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                <button type="button" class="btn btn-primary">Додати</button>
            </div>
        </div>
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Артикул</th>
            <th scope="col">Назва</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td><a href="'.URL_APP.'/products/1">mz323054</a></td>
            <td>Дерев`яна дошка кругла з виїмками під ковпак Hood 25х2, 5 см</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>mz323057</td>
            <td>Дерев`яна дошка овал з виїмкою 15х18 см</td>
        </tr>
    </tbody>
</table>
';   
include PATH_VIEWS ."layouts/main.php";