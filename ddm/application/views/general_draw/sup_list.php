<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>TKE - User Managerment</title>
<!-- Bootstrap Core CSS -->
<?php echo css(css_url('/bootstrap.min.css'));?>
<!-- MetisMenu CSS -->
<?php echo css(css_url('/metisMenu.min.css'));?>
<!-- DataTables CSS -->
<?php echo css(css_url('/dataTables.bootstrap.css'));?>
<!-- DataTables Responsive CSS -->
<!-- Custom CSS -->
<?php echo css(css_url('/sb-admin-2.css'));?>
<!-- Custom Fonts -->
<?php echo css(css_url('/font-awesome.min.css'));?>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- Default CSS -->
<?php echo css(css_url('/default.css'));?>
<!-- Custom CSS -->
<?php echo css(css_url('/ict-style.css'))?>
</head>
<body>





    <div class="row">
        <div class="col-xs-12" style="height: 20px"></div>
        <!-- /.col-xs-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-1">
                <label class="tableLabel">Dwg No</label>
            </div>
            <div class="col-xs-3">
                <input class="form-control normalInput" type="text" >
            </div>
            <div class="col-xs-2">      
                <label class="tableLabel">CG Filter or Supplier List</label>
            </div>
            <div class="col-xs-4">      
                <input class="form-control normalInput" type="text">
            </div> 
            <div>      
                <button class="btn btn-outline btn-blue" type="button" onclick="">Search</button>
            </div>      
        </div>
        
        <br><br>
        
        <div class="col-xs-12">
        
            <div class="col-xs-5">
               
                       <p>List</p>
                        <br>
                       <table class="table table-striped table-bordered table-hover dataTables_paging"
                            id="demoTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Sup Code</th>
                                    <th>Sup Name</th>
                                    <th>CG</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($article as $v): ?>
                                <tr>
                                    <td>No</td>
                                    <td class="align_middle"><?php echo $v['aid'] ?></td>
                                    <td><?php echo $v['title'] ?></td>
                                    <td><?php echo $v['cname'] ?></td>
                                    <td><?php echo date('m-d',$v['time']) ?></td>
                                </tr>
                                <?php endforeach ?>                     
                                
                                 <tr class="odd gradeX">
                                    <td></td>
                                    <td>Class-1</td>
                                    <td>State-1</td>
                                    <td>Dwg_No-1</td>
                                </tr>
                                 <tr class="odd gradeX">
                                    <td></td>
                                    <td>Class-1</td>
                                    <td>State-1</td>
                                    <td>Dwg_No-1</td>
                                </tr>
                                 <tr class="odd gradeX">
                                    <td></td>
                                    <td>Class-1</td>
                                    <td>State-1</td>
                                    <td>Dwg_No-1</td>
                                </tr>
                            </tbody>
                        </table> 
                        <button class="btn btn-outline btn-blue" type="button"
                            onclick="">Save</button> 
                        <button class="btn btn-outline btn-blue" type="button"
                            onclick="">Close</button>                   
                   
                
            </div>
            <div class="col-xs-1">
                 <br><br><br> <br><br>
                <p>
                <button class="btn btn-outline btn-blue" type="button"
                            onclick="">>></button>
                            </p>
                
                <br><br>
                
                <p>
                <button class="btn btn-outline btn-blue" type="button"
                            onclick=""><<</button>
                            </p>
            </div>
            <div class="col-xs-5">
            <div class="dataTable_wrapper">
                <p>Assigned Supplier</p>
                        <br>
                       <table class="table table-striped table-bordered table-hover dataTables_paging"
                            id="demoTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Sup Code</th>
                                    <th>Sup Name</th>
                                    <th>CG</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($article as $v): ?>
                                <tr>
                                    <td>No</td>
                                    <td class="align_middle"><?php echo $v['aid'] ?></td>
                                    <td><?php echo $v['title'] ?></td>
                                    <td><?php echo $v['cname'] ?></td>
                                </tr>
                                <?php endforeach ?>                     
                                
                                 <tr class="odd gradeX">
                                   <td>No</td>
                                    <td>Class-1</td>
                                    <td>State-1</td>
                                    <td>Dwg_No-1</td>
                                </tr>
                                 <tr class="odd gradeX">
                                    <td>No</td>
                                    <td>Class-1</td>
                                    <td>State-1</td>
                                    <td>Dwg_No-1</td>
                                </tr>
                                 <tr class="odd gradeX">
                                    <td>No</td>
                                    <td>Class-1</td>
                                    <td>State-1</td>
                                    <td>Dwg_No-1</td>
                                </tr>
                            </tbody>
                        </table> 
                   </div>     
            </div>
        </div>
        <!-- /.col-xs-12 -->
    </div>
    <!-- /.row -->   








    <footer id="footer">
        <div class="copyright">thyssenkrupp &#169; 2016</div>
    </footer>
    <!-- jQuery -->
    <?php echo js(js_url('/jquery.min.js'));?>
    <!-- Bootstrap Core JavaScript -->
    <?php echo js(js_url('/bootstrap.min.js'));?>
    <!-- Metis Menu Plugin JavaScript -->
    <?php echo js(js_url('/metisMenu.min.js'));?>
    <!-- DataTables JavaScript -->
    <?php echo js(js_url('/jquery.dataTables.min.js'));?>
    <?php echo js(js_url('/dataTables.bootstrap.min.js'));?>
    <!-- Custom Theme JavaScript -->
    <?php echo js(js_url('/sb-admin-2.js'));?>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('.dataTables_paging').DataTable({
                responsive: true,
                ordering:false,
                "bFilter": false,
                "sScrollX": "100%",  
                "sScrollXInner": "100%",  
                "bScrollCollapse": true 

        });
    });
    $(document).ready(function() {
        $('.dataTables_single').DataTable({
            "bPaginate": false,
            "bFilter": false,
            "bInfo": false,
            ordering:false,
            "sScrollX": "100%",  
            "sScrollXInner": "100%",  
            "bScrollCollapse": true 

        });
    });
    </script>
</body>
</html>


