@include('include.navbar')
@extends('layouts.app')

<div class="container">
	<div class="row" style="padding-top: 36px;">
		<div class="col-md-3 ">
		     <div class="list-group " id="list-tab" role="tablist" style="background-color: green;box-shadow: 5px 5px 3px grey;border-radius: 10px;">
              <a href="#" class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home" style="font-weight:600;color:#FAF6D5 !important">Dashboard</a>
              <a href="#" class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile" style="font-weight:600;color:#FAF6D5 !important">User Management</a>
              <a href="#" class="list-group-item list-group-item-action" style="font-weight:600;color:#FAF6D5 !important">Used</a>
              <a href="#" class="list-group-item list-group-item-action" style="font-weight:600;color:#FAF6D5 !important">Enquiry</a>
              <a href="#" class="list-group-item list-group-item-action" style="font-weight:600;color:#FAF6D5 !important">Dealer</a>
              <a href="#" class="list-group-item list-group-item-action" style="font-weight:600;color:#FAF6D5 !important">Media</a>
              <a href="#" class="list-group-item list-group-item-action" style="font-weight:600;color:#FAF6D5 !important">Post</a>


            </div>
		</div>
		<div class="col-md-9">
			<div class="tab-content" id="nav-tabContent">
				<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
					<div class="col-md-9">
					    <div class="card">
					        <div class="card-body">
					            <div class="row">
					                <div class="col-md-12">
					                    <h4>Your Profile</h4>
					                    <hr>
					                </div>
					            </div>
					            <div class="row">
					                <div class="col-md-12">
					                    <form>
			                              <div class="form-group row">
			                                <label for="username" class="col-4 col-form-label">User Name*</label>
			                                <div class="col-8">
			                                  <input id="username" name="username" placeholder="Username" class="form-control here" required="required" type="text">
			                                </div>
			                              </div>
			                              <div class="form-group row">
			                                <label for="name" class="col-4 col-form-label">First Name</label>
			                                <div class="col-8">
			                                  <input id="name" name="name" placeholder="First Name" class="form-control here" type="text">
			                                </div>
			                              </div>
			                              <div class="form-group row">
			                                <label for="lastname" class="col-4 col-form-label">Last Name</label>
			                                <div class="col-8">
			                                  <input id="lastname" name="lastname" placeholder="Last Name" class="form-control here" type="text">
			                                </div>
			                              </div>
			                              <div class="form-group row">
			                                <label for="text" class="col-4 col-form-label">Nick Name*</label>
			                                <div class="col-8">
			                                  <input id="text" name="text" placeholder="Nick Name" class="form-control here" required="required" type="text">
			                                </div>
			                              </div>
			                              <div class="form-group row">
			                                <label for="select" class="col-4 col-form-label">Display Name public as</label>
			                                <div class="col-8">
			                                  <select id="select" name="select" class="custom-select">
			                                    <option value="admin">Admin</option>
			                                  </select>
			                                </div>
			                              </div>
			                              <div class="form-group row">
			                                <label for="email" class="col-4 col-form-label">Email*</label>
			                                <div class="col-8">
			                                  <input id="email" name="email" placeholder="Email" class="form-control here" required="required" type="text">
			                                </div>
			                              </div>
			                              <div class="form-group row">
			                                <label for="website" class="col-4 col-form-label">Website</label>
			                                <div class="col-8">
			                                  <input id="website" name="website" placeholder="website" class="form-control here" type="text">
			                                </div>
			                              </div>
			                              <div class="form-group row">
			                                <label for="publicinfo" class="col-4 col-form-label">Public Info</label>
			                                <div class="col-8">
			                                  <textarea id="publicinfo" name="publicinfo" cols="40" rows="4" class="form-control"></textarea>
			                                </div>
			                              </div>
			                              <div class="form-group row">
			                                <label for="newpass" class="col-4 col-form-label">New Password</label>
			                                <div class="col-8">
			                                  <input id="newpass" name="newpass" placeholder="New Password" class="form-control here" type="text">
			                                </div>
			                              </div>
			                              <div class="form-group row">
			                                <div class="offset-4 col-8">
			                                  <button name="submit" type="submit" class="btn btn-primary">Update My Profile</button>
			                                </div>
			                              </div>
			                            </form>
					                </div>
					            </div>

					        </div>
					    </div>
					</div>
			</div>
				<div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
					<div class="col-md-9">
					    <div class="card">
					        <div class="card-body">
					            <div class="row">
					                <div class="col-md-12">
					                    <h4>Uw Bestellingen</h4>
					                    <hr>
					                </div>
					            </div>
					            <div class="row">
					                <div class="col-md-12">
					                    <form>
			                              <div class="form-group row">
			                                <label for="username" class="col-4 col-form-label">User Name*</label>
			                                <div class="col-8">
			                                  <input id="username" name="username" placeholder="Username" class="form-control here" required="required" type="text">
			                                </div>
			                              </div>
			                              <div class="form-group row">
			                                <label for="name" class="col-4 col-form-label">First Name</label>
			                                <div class="col-8">
			                                  <input id="name" name="name" placeholder="First Name" class="form-control here" type="text">
			                                </div>
			                              </div>
			                              <div class="form-group row">
			                                <label for="lastname" class="col-4 col-form-label">Last Name</label>
			                                <div class="col-8">
			                                  <input id="lastname" name="lastname" placeholder="Last Name" class="form-control here" type="text">
			                                </div>
			                              </div>
			                              <div class="form-group row">
			                                <label for="text" class="col-4 col-form-label">Nick Name*</label>
			                                <div class="col-8">
			                                  <input id="text" name="text" placeholder="Nick Name" class="form-control here" required="required" type="text">
			                                </div>
			                              </div>
			                              <div class="form-group row">
			                                <label for="select" class="col-4 col-form-label">Display Name public as</label>
			                                <div class="col-8">
			                                  <select id="select" name="select" class="custom-select">
			                                    <option value="admin">Admin</option>
			                                  </select>
			                                </div>
			                              </div>
			                              <div class="form-group row">
			                                <label for="email" class="col-4 col-form-label">Email*</label>
			                                <div class="col-8">
			                                  <input id="email" name="email" placeholder="Email" class="form-control here" required="required" type="text">
			                                </div>
			                              </div>
			                              <div class="form-group row">
			                                <label for="website" class="col-4 col-form-label">Website</label>
			                                <div class="col-8">
			                                  <input id="website" name="website" placeholder="website" class="form-control here" type="text">
			                                </div>
			                              </div>
			                              <div class="form-group row">
			                                <label for="publicinfo" class="col-4 col-form-label">Public Info</label>
			                                <div class="col-8">
			                                  <textarea id="publicinfo" name="publicinfo" cols="40" rows="4" class="form-control"></textarea>
			                                </div>
			                              </div>
			                              <div class="form-group row">
			                                <label for="newpass" class="col-4 col-form-label">New Password</label>
			                                <div class="col-8">
			                                  <input id="newpass" name="newpass" placeholder="New Password" class="form-control here" type="text">
			                                </div>
			                              </div>
			                              <div class="form-group row">
			                                <div class="offset-4 col-8">
			                                  <button name="submit" type="submit" class="btn btn-primary">Update My Profile</button>
			                                </div>
			                              </div>
			                            </form>
					                </div>
					            </div>

					        </div>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


</body>
</html>
