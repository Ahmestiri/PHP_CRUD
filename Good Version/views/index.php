    <h1 style="font-weight:bold">Products CRUD</h1>
    <!--Create Product Button-->
    <a href="/crud 1/create" type="button" class="btn btn-success" style="margin:30px 0px 10px">Create Product</a>
    <!--Search Form-->
    <form>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search for products" name = "search" value="<?php echo $search?>">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
        </div>
    </form>
    <!--Products Table-->
    <table class="table">
        <!--Table Header-->
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Price</th>
            <th scope="col">Create Date</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <!--Table Body-->
        <tbody>
            <?php foreach ($products as $i => $product) : ?>
                <tr>
                    <th style = "line-height:50px" scope="row"><?php echo $i+1 ?></th>
                    <td><img style = "width:50px" src="<?php echo $product['image'] ?>"></td>
                    <td style = "line-height:50px"><?php echo $product['title'] ?></td>
                    <td style = "line-height:50px"><?php echo $product['price'] ?></td>
                    <td style = "line-height:50px"><?php echo $product['create_date'] ?></td>
                    <td style = "line-height:40px">
                        <!--Edit Button-->
                        <a href="/crud 1/update?id=<?php echo $product['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                        <!--Delete Button-->
                        <form method="post" action="/crud 1/delete" style="display:inline-block">
                            <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>