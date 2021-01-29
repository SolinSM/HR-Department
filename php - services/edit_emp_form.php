<form action="control.php" method="post">
	<fieldset id="edit-form">
		<legend>Edit Employee Info</legend>
		<table>
			<tr>
				<td class="td_label"><label>First Name:</label></td>
				<td><input type="text" name="fname"></td>
				<td class="col_between"></td>
				<td class="td_label"><label>Last Name:</label></td>
				<td><input type="text" name="lname"></td>
			</tr>
			
			<tr>
				<td class="td_label"><label>Email:</label></td>
				<td><input type="email" name="email"></td>
				<td class="col_between"></td>
						
				<td class="td_label"><label>Favo Course:</label></td>
				<td colspan="4">						
					<select name="jobID">
						<option value="-1" selected>-- Choose One --</option>
						
						<?php
							require_once 'config.php';
							$sql = "select * from employee_jobs";  
							
							try{
								$stmt = $conn->prepare($sql);
								$stmt->execute();
								
							}catch(PDOException $ex){
								$msg = "Error: "  . $ex->getMessage();
									
								$my_response['result_status'] = "failed";
								$my_response['result_code'] = 102;
								$my_response['result_msg'] = $msg;
								die(json_encode($my_response));
							}
							
							$result = $stmt->fetchAll(PDO::FETCH_OBJ);
							if( $result && $stmt->rowCount() >= 1){
								foreach( $result as $job ){
								
									$job_id = $job->emp_job_id;
									$job_name = $job->job_name;
									echo "<option value='" . $job_id . "'>" . $job_name . "</option>";
								}	
							}
						?>
					</select>
				</td>
			</tr>
			
			<tr>
				<td colspan="5"><input type="submit" value="Submit" name="edit"></td>
			</tr>
			
		</table>
		
	</fieldset>
</form>