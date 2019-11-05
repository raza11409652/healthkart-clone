<?php
    require_once "includes/header.php";
    require_once "includes/nav.php";
?>
<section class="bmi-index">
  <div class="container">
      <h5>Calculate Your BMI</h5>
      <div class="row mt-5">
        <div class="col-lg-6">
          <label for="">Weight</label>
            <input id="weight" type="number" name="" value="" class="form-control">
        </div>
        <div class="col-lg-6">
          <label for="">Unit</label>
          <select id="weightUnit"
            onchange="weightChange()"
           class="form-control" name="">
            <option value="kg">
              kilogram (kg)
            </option>
            <option value="lb">
              Pound (lb)
            </option>
          </select>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-lg-6">
          <label for="">height</label>
            <input id="height" type="number" name="" value="" class="form-control">
        </div>
        <div class="col-lg-6">
          <label for="">Unit</label>
          <select id="heightUnit"
          onchange="heightChange()"
          class="form-control" name="">
            <option value="mt">
              Meter (m)
            </option>
            <option value="in">
              Inch (in)
            </option>
          </select>
        </div>
      </div>
      <div class="text-center mt-3">
        <a onclick="CalculateBmi()" class="btn btn-info">Calculate</a>
      </div>
      <table class="table mt-3">
				<thead class="thead-dark">
					<tr>
						<th class="text-left">BMI</th>
						<th class="text-left">Weight Status</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="text-left">Below 18.5</td>
						<td class="text-left">Underweight</td>
					</tr>
					<tr>
						<td class="text-left">18.5-24.9</td>
						<td class="text-left">Normal</td>
					</tr>
					<tr>
						<td class="text-left">25.0-29.9</td>
						<td class="text-left">Overweight</td>
					</tr>
					<tr>
						<td class="text-left">30.0 and Above</td>
						<td class="text-left">Obese</td>
					</tr>
				</tbody>
			</table>
  </div>
</section>
<?php require_once "includes/footer.php"; ?>
