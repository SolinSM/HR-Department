<form action="control.php" method="post">
	<fieldset id="mix-form">
		<legend>Manage Employee</legend>
		<table>
			
			<tr>
				<td class="td_label"><label>Email:</label></td>
				<td><input type="email" name="email"></td>
				<td class="col_between"></td>
				<td> </td>
			</tr>
			
			<tr>
				<td colspan="1"><input type="submit" value="Show All" name="select_all"></td>
				
				<td colspan="1"><input type="submit" value="Show Info" name="select_info"></td>
				<td colspan="2"><input type="submit" value="Search" name="find"></td>
				
				<td colspan="2"><input type="submit" value="Delete" name ="delete"></td>
			</tr>
			
		</table>
		
	</fieldset>
</form>