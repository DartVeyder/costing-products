<h3>Ресурси</h3>
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
                <h5 class="modal-title" id="exampleModalLabel">Додати новий ресурс</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Назва</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label">Одиниця виміру</label>
                        <select class="form-select" aria-label="Default select example" name="unit" id="unit">
                            <option value="1">кб. м.</option>
                            <option value="2">шт</option>
                            <option value="3">кг</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Ціна за одиницю</label>
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
            <th scope="col">Назва</th>
            <th scope="col">Одиниця виміру</th>
            <th scope="col">Ціна за одиницю</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Дерево</td>
            <td>кб. м.</td>
            <td>1000 грн</td>
            <td>
                <span class="resource-edit resource-btn">
                    <i role="button" class="fa fa-pencil " aria-hidden="true"></i>
                </span>
                <span class="resource-destroy  resource-btn">
                    <i role="button" class="fa fa-trash-o text-danger " aria-hidden="true"></i>
                </span>
            </td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Клей</td>
            <td>шт.</td>
            <td>100 грн</td>
            <td>
                <span class="resource-edit resource-btn">
                    <i role="button" class="fa fa-pencil " aria-hidden="true"></i>
                </span>
                <span class="resource-destroy  resource-btn">
                    <i role="button" class="fa fa-trash-o text-danger " aria-hidden="true"></i>
                </span>
            </td>
        </tr>
    </tbody>
</table>