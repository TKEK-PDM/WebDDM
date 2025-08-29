<div id="page-wrapper">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header">General Drawing</h1>
		</div>
	</div>
	<!-- search field -->
	<form class="ng-pristine ng-valid searchForm" role="form"></form>

	<!-- list start -->
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<!-- /.panel-heading -->
				<div class="panel-body">
					<ul id="myTab" class="nav nav-tabs">
						<li class="active"><a href="#search" data-toggle="tab">Search</a></li>
						<li><a href="#search_result" data-toggle="tab">Search Result</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade in active" id="search">
							<form class="ng-pristine ng-valid searchForm" role="form">
								<div class="row searchDiv" style="padding-left: 20px">
									<div class="row">
										<div class="col-xs-12">
											<label class="tableLabel">&nbsp;</label>
										</div>
										<div class="col-xs-1">
											<label class="tableLabel">Revision Status</label>
										</div>
										<div class="col-xs-10">
											<input name="revision_status" type="radio" value="latest"
												checked="checked"> Latest <input name="revision_status"
												type="radio" value="all_revision"> All Revision
										</div>
									</div>


									<div class="row">
										<div class="col-xs-12">
											<button class="btn btn-outline btn-blue buttonSpace"
												type="button" onclick="#">Search</button>
										</div>
									</div>

									<div class="row buttonSpace">
										<div class="col-xs-2">
											<label for="name">Input Drawing Numbers</label>
											<textarea class="form-control" rows="10"></textarea>
										</div>
									</div>
								</div>
							</form>
						</div>


						<div class="tab-pane fade" id="search_result">
							<div class="panel panel-default">
								<div class="panel-heading panel_blue">
									<b>General Drawing List</b>
								</div>
								<div class="panel-body" style="overflow-x: auto">
                                    <div class="dataTable_wrapper table_panel">
    									<table
    										class="table table-striped table-bordered table-hover dataTables_paging"
    										id="demoTable">
    										<thead>
    											<tr>
    												<th><input type="checkBox" id="" value=""></th>
    												<th>No</th>
    												<th>Site Name</th>
    												<th>Class</th>
    												<th>Dwg No</th>
    												<th>Revision</th>
    												<th>Dwg Name</th>
    												<th>File Type</th>
    												<th>File Name</th>
    												<th>Down Date</th>
    												<th>Down Time</th>
                                                    <!--
    												<th>Created By</th>
    												<th>Create Date</th>
    												<th>Create Time</th>
    												<th>Modified By</th>
    												<th>Modified Date</th>
    												<th>Modified Time</th>
                                                    -->
    											</tr>
    										</thead>
    										<tbody>
    											<tr class="odd gradeX">
    												<td class="align_middle"><input type="checkBox" id=""
    													value=""></td>
    												<td class="align_middle">1</td>
    												<td>test</td>
    												<td>test</td>
    												<td><a href="#" target="blank">Dwg No</a></td>
    												<td>test</td>
    												<td>test</td>
    												<td>test</td>
    												<td><a href="#" target="blank">FileName</a></td>
    												<td>test</td>
    												<td>test</td>
    												<!--
                                                    <td>test</td>
    												<td>test</td>
    												<td>test</td>
    												<td>test</td>
    												<td>test</td>
    												<td>test</td>
                                                    -->
    											</tr>
    											<tr class="odd gradeX">
    												<td class="align_middle"><input type="checkBox" id=""
    													value=""></td>
    												<td class="align_middle">2</td>
    												<td>test</td>
    												<td>test</td>
    												<td><a href="#" target="blank">Dwg No</a></td>
    												<td>test</td>
    												<td>test</td>
    												<td>test</td>
    												<td><a href="#" target="blank">FileName</a></td>
    												<td>test</td>
    												<td>test</td>
    												<!--
                                                    <td>test</td>
                                                    <td>test</td>
                                                    <td>test</td>
                                                    <td>test</td>
                                                    <td>test</td>
                                                    <td>test</td>
                                                    -->
    											</tr>
    											<tr class="odd gradeX">
    												<td class="align_middle"><input type="checkBox" id=""
    													value=""></td>
    												<td class="align_middle">3</td>
    												<td>test</td>
    												<td>test</td>
    												<td><a href="#" target="blank">Dwg No</a></td>
    												<td>test</td>
    												<td>test</td>
    												<td>test</td>
    												<td><a href="#" target="blank">FileName</a></td>
    												<td>test</td>
    												<td>test</td>
    												<!--
                                                    <td>test</td>
                                                    <td>test</td>
                                                    <td>test</td>
                                                    <td>test</td>
                                                    <td>test</td>
                                                    <td>test</td>
                                                    -->
    											</tr>
    										</tbody>
    									</table>
                                    </div>    
								</div>
							</div>
							<div class="col-xs-12">
								<button class="btn btn-outline btn-blue" type="button"
									onclick="">Multi Download</button>
							</div>
						</div>

					</div>

				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-xs-12 -->
	</div>
	<!-- list end -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.dataTables_paging').DataTable({
                responsive: true,
                ordering:false,
                "bFilter": false,
                "bAutoWidth": true,
                "bScrollCollapse": true  ,
    
        });
    });
   
</script>