<!DOCTYPE html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title>Create PDF </title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
</head>
<body>
<h1 class="text-center bg-info"></h1>
<table class="table table-striped table-hover">
  
    <thead>
        <tr>
            <th>Izina</th>
            <th>Amatazirano</th>
            <th>Se</th>
            <th>Nyina</th>
            <th>Provensi</th>
            <th>Commune</th>
            <th>yavukiye</th>
            <th>Akazi akora</th>         
            <th>Photo</th>         
        </tr>

    </thead>
    <tbody>
         
            <tr>
                <td><?=$karangamuntu['IZINA']?></td>
                <td><?=$karangamuntu['AMATAZIRANO']?></td>
                <td><?=$karangamuntu['SE']?></td>
                <td><?=$karangamuntu['NYINA']?></td>
                <td><?=$karangamuntu['PROVINCE_NAME']?></td>
                <td><?=$karangamuntu['COMMUNE_NAME']?></td>
                <td><?=$karangamuntu['ZONE_NAME']?></td>
                <td><?=$karangamuntu['AKAZI_AKORA']?></td>
                <td><?=$karangamuntu['PHOTO']?></td>
                <td><?=$karangamuntu['ITARIKI']?></td>
            </tr>
            <!-- <img src=""> -->
     
        
    <tbody> 
    
</table>
</body>
<style>
.table, th, td {
  border: 1px solid;
  background-color: rgb(255,255,255);
  font-size: 10px;
}
</style>

</html>