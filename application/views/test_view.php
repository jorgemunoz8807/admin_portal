<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<div id="container">
    <h1>Test Pagination</h1>

    <?php echo $this->pagination->create_links(); ?>
    <? echo $this->table->generate($records); ?>
    <? echo $this->pagination->create_links(); ?>

</div>

</body>
</html>