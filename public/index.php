<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:11 PM
 **/

use app\lib\App;

include __DIR__.'/../vendor/autoload.php';
$app       = new App();
$dashboard = $app->call('Dashboard');
$title     = 'Dashboard';
?>
<?php
include __DIR__.'/layouts/_header.php';
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-xl-12 wid-100">
			<div class="row">
				<div class="col-xl-3 col-sm-6">
					<div class="card chart-grd same-card">
						<div class="card-body depostit-card p-0">
							<div class="depostit-card-media d-flex justify-content-between pb-0">
								<div>
									<h6>Vốn</h6>
									<h3>$1200.00</h3>
								</div>
								<div class="icon-box bg-primary-light">
									<svg width="12" height="20" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M11.4642 13.7074C11.4759 12.1252 10.8504 10.8738 9.60279 9.99009C8.6392 9.30968 7.46984 8.95476 6.33882 8.6137C3.98274 7.89943 3.29927 7.52321 3.29927 6.3965C3.29927 5.14147 4.93028 4.69493 6.32655 4.69493C7.34341 4.69493 8.51331 5.01109 9.23985 5.47964L10.6802 3.24887C9.73069 2.6333 8.43112 2.21342 7.14783 2.0831V0H4.49076V2.22918C2.12884 2.74876 0.640949 4.29246 0.640949 6.3965C0.640949 7.87005 1.25327 9.03865 2.45745 9.86289C3.37331 10.4921 4.49028 10.83 5.56927 11.1572C7.88027 11.8557 8.81873 12.2813 8.80805 13.691L8.80799 13.7014C8.80799 14.8845 7.24005 15.3051 5.89676 15.3051C4.62786 15.3051 3.248 14.749 2.46582 13.9222L0.535522 15.7481C1.52607 16.7957 2.96523 17.5364 4.4907 17.8267V20.0001H7.14783V17.8735C9.7724 17.4978 11.4616 15.9177 11.4642 13.7074Z" fill="var(--primary)"/>
									</svg>
								</div>
							</div>
							<div id="NewCustomers"></div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6">
					<div class="card chart-grd same-card">
						<div class="card-body depostit-card p-0">
							<div class="depostit-card-media d-flex justify-content-between pb-0">
								<div>
									<h6>Doanh Thu</h6>
									<h3>$1200.00</h3>
								</div>
								<div class="icon-box bg-danger-light">
									<svg width="12" height="20" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M11.4642 13.7074C11.4759 12.1252 10.8504 10.8738 9.60279 9.99009C8.6392 9.30968 7.46984 8.95476 6.33882 8.6137C3.98274 7.89943 3.29927 7.52321 3.29927 6.3965C3.29927 5.14147 4.93028 4.69493 6.32655 4.69493C7.34341 4.69493 8.51331 5.01109 9.23985 5.47964L10.6802 3.24887C9.73069 2.6333 8.43112 2.21342 7.14783 2.0831V0H4.49076V2.22918C2.12884 2.74876 0.640949 4.29246 0.640949 6.3965C0.640949 7.87005 1.25327 9.03865 2.45745 9.86289C3.37331 10.4921 4.49028 10.83 5.56927 11.1572C7.88027 11.8557 8.81873 12.2813 8.80805 13.691L8.80799 13.7014C8.80799 14.8845 7.24005 15.3051 5.89676 15.3051C4.62786 15.3051 3.248 14.749 2.46582 13.9222L0.535522 15.7481C1.52607 16.7957 2.96523 17.5364 4.4907 17.8267V20.0001H7.14783V17.8735C9.7724 17.4978 11.4616 15.9177 11.4642 13.7074Z" fill="#FF5E5E"/>
									</svg>
								</div>
							</div>
							<div id="NewExperience"></div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6">
					<div class="card chart-grd same-card">
						<div class="card-body depostit-card p-0">
							<div class="depostit-card-media d-flex justify-content-between pb-0">
								<div>
									<h6>Lợi Nhuận</h6>
									<h3>$1200.00</h3>
								</div>
								<div class="icon-box bg-danger-light">
									<svg width="12" height="20" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M11.4642 13.7074C11.4759 12.1252 10.8504 10.8738 9.60279 9.99009C8.6392 9.30968 7.46984 8.95476 6.33882 8.6137C3.98274 7.89943 3.29927 7.52321 3.29927 6.3965C3.29927 5.14147 4.93028 4.69493 6.32655 4.69493C7.34341 4.69493 8.51331 5.01109 9.23985 5.47964L10.6802 3.24887C9.73069 2.6333 8.43112 2.21342 7.14783 2.0831V0H4.49076V2.22918C2.12884 2.74876 0.640949 4.29246 0.640949 6.3965C0.640949 7.87005 1.25327 9.03865 2.45745 9.86289C3.37331 10.4921 4.49028 10.83 5.56927 11.1572C7.88027 11.8557 8.81873 12.2813 8.80805 13.691L8.80799 13.7014C8.80799 14.8845 7.24005 15.3051 5.89676 15.3051C4.62786 15.3051 3.248 14.749 2.46582 13.9222L0.535522 15.7481C1.52607 16.7957 2.96523 17.5364 4.4907 17.8267V20.0001H7.14783V17.8735C9.7724 17.4978 11.4616 15.9177 11.4642 13.7074Z" fill="#FF5E5E"/>
									</svg>
								</div>
							</div>
							<div id="NewExperience"></div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 same-card">
					<div class="card">
						<div class="card-body depostit-card">
							<div class="depostit-card-media d-flex justify-content-between style-1">
								<div>
									<h6>KPI</h6>
									<h3>$20000</h3>
								</div>
								<div class="icon-box bg-primary-light">
									<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M16.3787 1.875H15.625V1.25C15.625 1.08424 15.5592 0.925268 15.4419 0.808058C15.3247 0.690848 15.1658 0.625 15 0.625C14.8342 0.625 14.6753 0.690848 14.5581 0.808058C14.4408 0.925268 14.375 1.08424 14.375 1.25V1.875H10.625V1.25C10.625 1.08424 10.5592 0.925268 10.4419 0.808058C10.3247 0.690848 10.1658 0.625 10 0.625C9.83424 0.625 9.67527 0.690848 9.55806 0.808058C9.44085 0.925268 9.375 1.08424 9.375 1.25V1.875H5.625V1.25C5.625 1.08424 5.55915 0.925268 5.44194 0.808058C5.32473 0.690848 5.16576 0.625 5 0.625C4.83424 0.625 4.67527 0.690848 4.55806 0.808058C4.44085 0.925268 4.375 1.08424 4.375 1.25V1.875H3.62125C2.99266 1.87599 2.3901 2.12614 1.94562 2.57062C1.50114 3.0151 1.25099 3.61766 1.25 4.24625V17.0037C1.25099 17.6323 1.50114 18.2349 1.94562 18.6794C2.3901 19.1239 2.99266 19.374 3.62125 19.375H16.3787C17.0073 19.374 17.6099 19.1239 18.0544 18.6794C18.4989 18.2349 18.749 17.6323 18.75 17.0037V4.24625C18.749 3.61766 18.4989 3.0151 18.0544 2.57062C17.6099 2.12614 17.0073 1.87599 16.3787 1.875ZM17.5 17.0037C17.499 17.3008 17.3806 17.5854 17.1705 17.7955C16.9604 18.0056 16.6758 18.124 16.3787 18.125H3.62125C3.32418 18.124 3.03956 18.0056 2.8295 17.7955C2.61944 17.5854 2.50099 17.3008 2.5 17.0037V4.24625C2.50099 3.94918 2.61944 3.66456 2.8295 3.4545C3.03956 3.24444 3.32418 3.12599 3.62125 3.125H4.375V3.75C4.375 3.91576 4.44085 4.07473 4.55806 4.19194C4.67527 4.30915 4.83424 4.375 5 4.375C5.16576 4.375 5.32473 4.30915 5.44194 4.19194C5.55915 4.07473 5.625 3.91576 5.625 3.75V3.125H9.375V3.75C9.375 3.91576 9.44085 4.07473 9.55806 4.19194C9.67527 4.30915 9.83424 4.375 10 4.375C10.1658 4.375 10.3247 4.30915 10.4419 4.19194C10.5592 4.07473 10.625 3.91576 10.625 3.75V3.125H14.375V3.75C14.375 3.91576 14.4408 4.07473 14.5581 4.19194C14.6753 4.30915 14.8342 4.375 15 4.375C15.1658 4.375 15.3247 4.30915 15.4419 4.19194C15.5592 4.07473 15.625 3.91576 15.625 3.75V3.125H16.3787C16.6758 3.12599 16.9604 3.24444 17.1705 3.4545C17.3806 3.66456 17.499 3.94918 17.5 4.24625V17.0037Z" fill="var(--primary)"/>
										<path d="M7.68311 7.05812L6.24999 8.49125L5.44186 7.68312C5.38421 7.62343 5.31524 7.57581 5.23899 7.54306C5.16274 7.5103 5.08073 7.49306 4.99774 7.49234C4.91475 7.49162 4.83245 7.50743 4.75564 7.53886C4.67883 7.57028 4.60905 7.61669 4.55037 7.67537C4.49168 7.73406 4.44528 7.80384 4.41385 7.88065C4.38243 7.95746 4.36661 8.03976 4.36733 8.12275C4.36805 8.20573 4.3853 8.28775 4.41805 8.364C4.45081 8.44025 4.49842 8.50922 4.55811 8.56687L5.80811 9.81687C5.92532 9.93404 6.08426 9.99986 6.24999 9.99986C6.41572 9.99986 6.57466 9.93404 6.69186 9.81687L8.56686 7.94187C8.68071 7.82399 8.74371 7.66612 8.74229 7.50224C8.74086 7.33837 8.67513 7.18161 8.55925 7.06573C8.44337 6.94985 8.28661 6.88412 8.12274 6.8827C7.95887 6.88127 7.80099 6.94427 7.68311 7.05812Z" fill="var(--primary)"/>
										<path d="M15 8.125H10.625C10.4592 8.125 10.3003 8.19085 10.1831 8.30806C10.0658 8.42527 10 8.58424 10 8.75C10 8.91576 10.0658 9.07473 10.1831 9.19194C10.3003 9.30915 10.4592 9.375 10.625 9.375H15C15.1658 9.375 15.3247 9.30915 15.4419 9.19194C15.5592 9.07473 15.625 8.91576 15.625 8.75C15.625 8.58424 15.5592 8.42527 15.4419 8.30806C15.3247 8.19085 15.1658 8.125 15 8.125Z" fill="var(--primary)"/>
										<path d="M7.68311 12.6831L6.24999 14.1162L5.44186 13.3081C5.38421 13.2484 5.31524 13.2008 5.23899 13.1681C5.16274 13.1353 5.08073 13.1181 4.99774 13.1173C4.91475 13.1166 4.83245 13.1324 4.75564 13.1639C4.67883 13.1953 4.60905 13.2417 4.55037 13.3004C4.49168 13.3591 4.44528 13.4288 4.41385 13.5056C4.38243 13.5825 4.36661 13.6648 4.36733 13.7477C4.36805 13.8307 4.3853 13.9127 4.41805 13.989C4.45081 14.0653 4.49842 14.1342 4.55811 14.1919L5.80811 15.4419C5.92532 15.559 6.08426 15.6249 6.24999 15.6249C6.41572 15.6249 6.57466 15.559 6.69186 15.4419L8.56686 13.5669C8.68071 13.449 8.74371 13.2911 8.74229 13.1272C8.74086 12.9634 8.67513 12.8066 8.55925 12.6907C8.44337 12.5749 8.28661 12.5091 8.12274 12.5077C7.95887 12.5063 7.80099 12.5693 7.68311 12.6831Z" fill="var(--primary)"/>
										<path d="M15 13.75H10.625C10.4592 13.75 10.3003 13.8158 10.1831 13.9331C10.0658 14.0503 10 14.2092 10 14.375C10 14.5408 10.0658 14.6997 10.1831 14.8169C10.3003 14.9342 10.4592 15 10.625 15H15C15.1658 15 15.3247 14.9342 15.4419 14.8169C15.5592 14.6997 15.625 14.5408 15.625 14.375C15.625 14.2092 15.5592 14.0503 15.4419 13.9331C15.3247 13.8158 15.1658 13.75 15 13.75Z" fill="var(--primary)"/>
									</svg>

								</div>
							</div>
							<div class="progress-box mt-0">
								<div class="d-flex justify-content-between">
									<p class="mb-0">Tiến Độ</p>
									<p class="mb-0">50% ($10000)</p>
								</div>
								<div class="progress">
									<div class="progress-bar bg-primary" style="width:50%; height:5px; border-radius:4px;" role="progressbar"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-12 bst-seller">
			<div class="card">
				<div class="card-header border-0">
					<h4 class="heading mb-0">Best Selling Products</h4>
					<div class="d-flex align-items-center cs-settiong">
						<span>SORT BY:</span>
						<select class="default-select status-select normal-select">
							<option value="Today">Today</option>
							<option value="Week">Week</option>
							<option value="Month">Month</option>
						</select>
					</div>
				</div>
				<div class="card-body p-0">
					<div class="table-responsive active-projects active-projects ItemsCheckboxSec selling-product shorting ">
						<table id="product-tbl" class="table ">
							<thead>
							<tr>
								<th>
									<div class="form-check custom-checkbox ms-0">
										<input type="checkbox" class="form-check-input checkAllInput" required="">
										<label class="form-check-label" for="checkAll1"></label>
									</div>
								</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Orders</th>
								<th>Stock</th>
								<th>Amount</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>
									<div class="form-check custom-checkbox">
										<input type="checkbox" class="form-check-input" id="customCheckBox22" required="">
										<label class="form-check-label" for="customCheckBox22"></label>
									</div>
								</td>
								<td>
									<div class="products">
										<img src="/assets/images/contacts/d1.jpg" class="avatar avatar-md" alt="">
										<div>
											<h6><a href="javascript:void(0)">lether Dress</a></h6>
											<span>24 Apr 2021</span>
										</div>
									</div>
								</td>
								<td>
									<span class="text-primary">$85.20</span>
								</td>
								<td>
									<span>750</span>
								</td>
								<td>
									<span class="badge badge-danger light border-0">Out of Stock</span>
								</td>
								<td>
									<span>$1200.75</span>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-check custom-checkbox">
										<input type="checkbox" class="form-check-input" id="customCheckBox23" required="">
										<label class="form-check-label" for="customCheckBox23"></label>
									</div>
								</td>
								<td>
									<div class="products">
										<img src="/assets/images/contacts/d2.jpg" class="avatar avatar-md" alt="">
										<div>
											<h6><a href="javascript:void(0)">Men Jacket</a></h6>
											<span>24 Apr 2021</span>
										</div>
									</div>
								</td>
								<td>
									<span class="text-primary">$85.20</span>
								</td>
								<td>
									<span>750</span>
								</td>
								<td>
									<span class="badge badge-danger light border-0">Out of Stock</span>
								</td>
								<td>
									<span>$1200.75</span>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-check custom-checkbox">
										<input type="checkbox" class="form-check-input" id="customCheckBox24" required="">
										<label class="form-check-label" for="customCheckBox24"></label>
									</div>
								</td>
								<td>
									<div class="products">
										<img src="/assets/images/contacts/d3.jpg" class="avatar avatar-md" alt="">
										<div>
											<h6><a href="javascript:void(0)">Midi Dress</a></h6>
											<span>24 Apr 2021</span>
										</div>
									</div>
								</td>
								<td>
									<span class="text-primary">$85.20</span>
								</td>
								<td>
									<span>750</span>
								</td>
								<td>
									<span class="badge badge-success light border-0">In Stock</span>
								</td>
								<td>
									<span>$1200.75</span>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-check custom-checkbox">
										<input type="checkbox" class="form-check-input" id="customCheckBox25" required="">
										<label class="form-check-label" for="customCheckBox25"></label>
									</div>
								</td>
								<td>
									<div class="products">
										<img src="/assets/images/contacts/d4.jpg" class="avatar avatar-md" alt="">
										<div>
											<h6><a href="javascript:void(0)">Boy Dress</a></h6>
											<span>24 Apr 2021</span>
										</div>
									</div>
								</td>
								<td>
									<span class="text-primary">$85.20</span>
								</td>
								<td>
									<span>750</span>
								</td>
								<td>
									<span class="badge badge-success light border-0">In Stock</span>
								</td>
								<td>
									<span>$1200.75</span>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-check custom-checkbox">
										<input type="checkbox" class="form-check-input" id="customCheckBox26" required="">
										<label class="form-check-label" for="customCheckBox26"></label>
									</div>
								</td>
								<td>
									<div class="products">
										<img src="/assets/images/contacts/d5.jpg" class="avatar avatar-md" alt="">
										<div>
											<h6><a href="javascript:void(0)">Teen Dress</a></h6>
											<span>24 Apr 2021</span>
										</div>
									</div>
								</td>
								<td>
									<span class="text-primary">$85.20</span>
								</td>
								<td>
									<span>750</span>
								</td>
								<td>
									<span class="badge badge-success light border-0">In Stock</span>
								</td>
								<td>
									<span>$1200.75</span>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-check custom-checkbox">
										<input type="checkbox" class="form-check-input" id="customCheckBox27" required="">
										<label class="form-check-label" for="customCheckBox27"></label>
									</div>
								</td>
								<td>
									<div class="products">
										<img src="/assets/images/contacts/d6.jpg" class="avatar avatar-md" alt="">
										<div>
											<h6><a href="javascript:void(0)">White Top Dress</a></h6>
											<span>24 Apr 2021</span>
										</div>
									</div>
								</td>
								<td>
									<span class="text-primary">$85.20</span>
								</td>
								<td>
									<span>750</span>
								</td>
								<td>
									<span class="badge badge-danger light border-0">Out of Stock</span>
								</td>
								<td>
									<span>$1200.75</span>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-check custom-checkbox">
										<input type="checkbox" class="form-check-input" id="customCheckBox28" required="">
										<label class="form-check-label" for="customCheckBox28"></label>
									</div>
								</td>
								<td>
									<div class="products">
										<img src="/assets/images/contacts/d7.jpg" class="avatar avatar-md" alt="">
										<div>
											<h6><a href="javascript:void(0)">Mobile</a></h6>
											<span>24 Apr 2021</span>
										</div>
									</div>
								</td>
								<td>
									<span class="text-primary">$85.20</span>
								</td>
								<td>
									<span>750</span>
								</td>
								<td>
									<span class="badge badge-success light border-0">In Stock</span>
								</td>
								<td>
									<span>$1200.75</span>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-check custom-checkbox">
										<input type="checkbox" class="form-check-input" id="customCheckBox29" required="">
										<label class="form-check-label" for="customCheckBox29"></label>
									</div>
								</td>
								<td>
									<div class="products">
										<img src="/assets/images/contacts/d8.jpg" class="avatar avatar-md" alt="">
										<div>
											<h6><a href="javascript:void(0)">Laptop</a></h6>
											<span>24 Apr 2021</span>
										</div>
									</div>
								</td>
								<td>
									<span class="text-primary">$85.20</span>
								</td>
								<td>
									<span>750</span>
								</td>
								<td>
									<span class="badge badge-danger light border-0">Out of Stock</span>
								</td>
								<td>
									<span>$1200.75</span>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-check custom-checkbox">
										<input type="checkbox" class="form-check-input" id="customCheckBox30" required="">
										<label class="form-check-label" for="customCheckBox30"></label>
									</div>
								</td>
								<td>
									<div class="products">
										<img src="/assets/images/contacts/d14.jpg" class="avatar avatar-md" alt="">
										<div>
											<h6><a href="javascript:void(0)">Air Conditioner</a></h6>
											<span>24 Apr 2021</span>
										</div>
									</div>
								</td>
								<td>
									<span class="text-primary">$85.20</span>
								</td>
								<td>
									<span>750</span>
								</td>
								<td>
									<span class="badge badge-success light border-0">In Stock</span>
								</td>
								<td>
									<span>$1200.75</span>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-check custom-checkbox">
										<input type="checkbox" class="form-check-input" id="customCheckBox31" required="">
										<label class="form-check-label" for="customCheckBox31"></label>
									</div>
								</td>
								<td>
									<div class="products">
										<img src="/assets/images/contacts/d13.jpg" class="avatar avatar-md" alt="">
										<div>
											<h6><a href="javascript:void(0)">Blade Table Fan</a></h6>
											<span>24 Apr 2021</span>
										</div>
									</div>
								</td>
								<td>
									<span class="text-primary">$85.20</span>
								</td>
								<td>
									<span>750</span>
								</td>
								<td>
									<span class="badge badge-success light border-0">In Stock</span>
								</td>
								<td>
									<span>$1200.75</span>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-check custom-checkbox">
										<input type="checkbox" class="form-check-input" id="customCheckBox32" required="">
										<label class="form-check-label" for="customCheckBox32"></label>
									</div>
								</td>
								<td>
									<div class="products">
										<img src="/assets/images/contacts/d9.jpg" class="avatar avatar-md" alt="">
										<div>
											<h6><a href="javascript:void(0)">Earphone</a></h6>
											<span>24 Apr 2021</span>
										</div>
									</div>
								</td>
								<td>
									<span class="text-primary">$85.20</span>
								</td>
								<td>
									<span>750</span>
								</td>
								<td>
									<span class="badge badge-success light border-0">In Stock</span>
								</td>
								<td>
									<span>$1200.75</span>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-check custom-checkbox">
										<input type="checkbox" class="form-check-input" id="customCheckBox33" required="">
										<label class="form-check-label" for="customCheckBox33"></label>
									</div>
								</td>
								<td>
									<div class="products">
										<img src="/assets/images/contacts/d10.jpg" class="avatar avatar-md" alt="">
										<div>
											<h6><a href="javascript:void(0)">Bag Pack</a></h6>
											<span>24 Apr 2021</span>
										</div>
									</div>
								</td>
								<td>
									<span class="text-primary">$86.20</span>
								</td>
								<td>
									<span>750</span>
								</td>
								<td>
									<span class="badge badge-danger light border-0">Out of Stock</span>
								</td>
								<td>
									<span>$1200.75</span>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-check custom-checkbox">
										<input type="checkbox" class="form-check-input" id="customCheckBox34" required="">
										<label class="form-check-label" for="customCheckBox34"></label>
									</div>
								</td>
								<td>
									<div class="products">
										<img src="/assets/images/contacts/d11.jpg" class="avatar avatar-md" alt="">
										<div>
											<h6><a href="javascript:void(0)">lether jacket</a></h6>
											<span>24 Apr 2021</span>
										</div>
									</div>
								</td>
								<td>
									<span class="text-primary">$85.20</span>
								</td>
								<td>
									<span>750</span>
								</td>
								<td>
									<span class="badge badge-success light border-0">In Stock</span>
								</td>
								<td>
									<span>$1200.75</span>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-check custom-checkbox">
										<input type="checkbox" class="form-check-input" id="customCheckBox35" required="">
										<label class="form-check-label" for="customCheckBox35"></label>
									</div>
								</td>
								<td>
									<div class="products">
										<img src="/assets/images/contacts/d12.jpg" class="avatar avatar-md" alt="">
										<div>
											<h6><a href="javascript:void(0)">Black Dress</a></h6>
											<span>24 Apr 2021</span>
										</div>
									</div>
								</td>
								<td>
									<span class="text-primary">$85.20</span>
								</td>
								<td>
									<span>750</span>
								</td>
								<td>
									<span class="badge badge-success light border-0">In Stock</span>
								</td>
								<td>
									<span>$1200.75</span>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include __DIR__.'/layouts/_footer.php';
?>


