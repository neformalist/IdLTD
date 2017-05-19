<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="/style.css" rel= "stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title>Independent developers LTD</title>
</head>
<body>
<div class="container-fluid" style="padding: 5%;">
    <div class="right"><a href="javascript:void(0);" data-toggle="modal" data-target="#CreateModal" id="add"><i class="glyphicon glyphicon-plus"></i>Add</a></div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Наименование товара</th>
            <th>Категория товара</th>
            <th>Стоимость</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody class="table-body">

        <?php foreach ($product as $item): ?>
            <tr data-id = "<?=$item['id']?>">
                <td><?=$item['id']?></td>
                <td><?=$item['name']?></td>
                <td data-id="<?=$item['category_id']?>"><?=$item['category']?></td>
                <td><?=$item['price']?></td>
                <td><span data-toggle="modal" data-target="#exampleModal" data-id = "<?=$item['id']?>" class="glyphicon glyphicon-pencil pointer"></span></td>
                <td><span data-toggle="modal" data-target="#DeleteModal" data-id = "<?=$item['id']?>" class="glyphicon glyphicon-trash pointer"></span></td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Edit product</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="ID">
                    <div class="form-group">
                        <label for="name" class="control-label">Title:</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="price" class="control-label">Price:</label>
                        <input type="number" min="0" class="form-control" id="price" >
                    </div>
                    <div class="form-group">
                        <label for="category" class="control-label">Category:</label>
                        <select  class="form-control" id="category" >
                            <?php foreach ($category as $item): ?>
                                <option value="<?=$item['id']?>"><?=$item['name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="update" type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel2">Add product</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="ID">
                    <div class="form-group">
                        <label for="name" class="control-label">Title:</label>
                        <input type="text" class="form-control" id="name-create">
                    </div>
                    <div class="form-group">
                        <label for="price" class="control-label">Price:</label>
                        <input type="number" min="0" class="form-control" id="price-create" >
                    </div>
                    <div class="form-group">
                        <label for="category" class="control-label">Category:</label>
                        <select  class="form-control" id="category-create" >
                            <?php foreach ($category as $item): ?>
                                <option value="<?=$item['id']?>"><?=$item['name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="create" type="button" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Delete product</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="ID-delete">
                </form>
                Do you really want to delete?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="delete" type="button" class="btn btn-primary">Delete</button>
            </div>
        </div>
    </div>
</div>
<script src="js.js"></script>
</body>
</html>