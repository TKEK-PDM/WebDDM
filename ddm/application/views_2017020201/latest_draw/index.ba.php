<div id="page-wrapper">

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Latest Drawing</h1>
		</div>
	</div>

	<!-- list start -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading panel_blue">
					<b>Drawing List</b>
				</div>
				<div class="panel-body">
					<div class="dataTable_wrapper table_panel">
						<table
							class="table table-striped table-bordered table-hover"
							id="demoTable">
							<thead>
								<tr>
									<th><input type="checkBox" id="" value=""></th>
									<th>No</th>
									<th>Site Name</th>
									<th>Class</th>
									<th>Dwg No</th>
									<th>My Rev</th>

									<th>tkeK Rev</th>
									<th>Dwg Name</th>
									<th>File Type</th>
									<th>File Name</th>
							<!--		
                                    <th>Created By</th>
									<th>Create Date</th>
									<th>Create Time</th>
									<th>Modified By</th>
									<th>Modified Date</th>
									<th>Modified Time</th>  
                             -->
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="align_middle"><input type="checkBox" id="" value=""></td>
									<td class="align_middle">1</td>
									<td>KO</td>
									<td><?php echo date('m-d',$v['time']) ?></td>
                                    <td><a href="#" target="blank">Dwg No</a></td>

									<td>My Rev</td>
									<td>tkeK Rev</td>
									<td>Dwg Name</td>
									<td>File Type</td>
									<td><a href="#" target="blank">File Name</a></td>
									<!--
                                    <td>test</td>
									<td>test</td>
									<td>test</td>
									<td>test</td>
									<td>test</td>
									<td>test</td> 
                                    -->
									<td><button class="btn btn-outline btn-blue" type="button"
											onclick="">Save</button></td>
								</tr>
								<tr>
									<td class="align_middle"><input type="checkBox" id="" value=""></td>
									<td class="align_middle">2</td>
									<td>KO</td>
									<td><?php echo date('m-d',$v['time']) ?></td>
                                    <td><a href="#" target="blank">Dwg No</a></td>

									<td>My Rev</td>
									<td>tkeK Rev</td>
									<td>Dwg Name</td>
									<td>File Type</td>
									<td><a href="#" target="blank">File Name</a></td>
									<!--
                                    <td>test</td>
                                    <td>test</td>
                                    <td>test</td>
                                    <td>test</td>
                                    <td>test</td>
                                    <td>test</td> 
                                    -->
									<td><button class="btn btn-outline btn-blue" type="button"
											onclick="">Save</button></td>
								</tr>
								<tr>
									<td class="align_middle"><input type="checkBox" id="" value=""></td>
									<td class="align_middle">3</td>
									<td>KO</td>
									<td><?php echo date('m-d',$v['time']) ?></td>
                                    <td><a href="#" target="blank">Dwg No</a></td>

									<td>My Rev</td>
									<td>tkeK Rev</td>
									<td>Dwg Name</td>
									<td>File Type</td>
									<td><a href="#" target="blank">File Name</a></td>
									<!--
                                    <td>test</td>
                                    <td>test</td>
                                    <td>test</td>
                                    <td>test</td>
                                    <td>test</td>
                                    <td>test</td> 
                                    -->
									<td><button class="btn btn-outline btn-blue" type="button"
											onclick="">Save</button></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-lg-12">
						<button class="btn btn-outline btn-blue" type="button" onclick="">Multi
							Download</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- list end -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.dataTables_single').DataTable({
            "bPaginate": false,
            "bFilter": false,
            "bInfo": false,
            ordering:false,
        });
    });
</script>