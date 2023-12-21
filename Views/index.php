<?php include(VIES.inc/header.php); ?> 

    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <table class="table">
                <thread class="thread-dark">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">quantity</th>
                        <th scope="col">Description</th>
                        <th scope="col">urlimg</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                </thread>
                <tbody>
                <?php foreach($products as $row): ?> 
                    <tr>
                        <td> <?php echo $i; $i++; ?></td>
                        <td> <?php echo $row['name']; ?></td>
                        <td> <?php echo $row['price']; ?><b class="Float-right"> $ </b></td>
                        <td class="text-center><td> <?php echo $row['description']; ?></td>
                        <td> <?php echo $row['qty']; ?></td>
                        <td>
                            <a href="<?php url('product/edit/'.$row['id'])?> class="btn btn-info"> Edit</a>
                </td>
                <td>
                <a href="<?php url('product/delete/'.$row['id'])?>" class="btn btn-danger"> Delete</a>
                </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
<?php include(Views.'inc/footer.php'); ?>

