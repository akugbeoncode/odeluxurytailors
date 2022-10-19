<template>
  <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-4 col-4">
        <h4 class="page-title">New Transaction</h4>
      </div>
      <div class="col-sm-8 col-8 text-right">
        <router-link 
          :to="{
            name: 'ServiceUserAccountDashboard',
            params: {
              loggedUserID: loggedUser.id
            }
          }" 
          class="btn btn-outline-danger"
        ><i class="fa fa-times mr-2"></i> Cancel</router-link>
      </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10 text-center p-0 mb-2">
            <div class="card px-0 pt-4 pb-0 mb-3">
                <form id="msform">
                    <!-- progressbar -->
                    <ul id="progressbar" style="padding: 0px;">
                        <li class="active" id="transaction-details"><strong>Transaction Details</strong></li>
                        <li id="fabric-measurement-details"><strong>Fabric Measurement Details</strong></li>
                        <li id="transaction-summary"><strong>Transaction Summary</strong></li>
                    </ul>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> <br> <!-- fieldsets -->
                    <fieldset>
                        <div class="form-card mb-5">
                            <div class="row">
                                <div class="col-9">
                                    <h2 class="fs-title">Transaction Details:</h2>
                                </div>
                                <div class="col-3">
                                    <h2 class="steps"></h2>
                                </div>
                            </div> 
                            <div class="row">
                              <div class="col-12">
                                <div class="form-group form-focus focused mb-0">
                                  <label class="focus-label">Transaction ID</label>
                                  <input class="form-control floating"  type="text" readonly>
                                </div>
                                <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                              </div>

                              <div class="col-sm-6">
                                <label for="firstName" class="form-label">Pick-up Date</label>
                                <input type="date" class="form-control" required="">
                                <div class="invalid-feedback">
                                  Valid first name is required.
                                </div>
                              </div>

                              <div class="col-sm-6">
                                <label for="lastName" class="form-label">Number of Fabrics</label>
                                <input type="number" class="form-control" required="">
                                <div class="invalid-feedback">
                                  Valid last name is required.
                                </div>
                              </div>

                              <div class="col-12">
                                <label for="lastName" class="form-label">Description</label>
                                <textarea class="form-control" required=""></textarea>
                                <div class="invalid-feedback">
                                  Valid last name is required.
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="form-card  mb-5">
                            <div class="row">
                                <div class="col-9">
                                    <h2 class="fs-title">Client Details:</h2>
                                </div>
                                <div class="col-3">
                                    
                                </div>
                            </div> 
                            <div class="row">
                               <div class="col-12 mb-3">
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="inlineRadioOptions" v-model="selectedClientOption" value="returning client" checked>
                                  <label class="form-check-label">Returning Client</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="inlineRadioOptions" v-model="selectedClientOption" value="new client">
                                  <label class="form-check-label">New Client</label>
                                </div>
                              </div>
                            </div>

                            <div v-if="showReturningClient" class="row">
                              <div class="col-12">
                                <div class="form-group form-focus focused mb-0">
                                <label class="focus-label pl-2 mb-2">Client Record</label>
                                <select class="form-control mt-2">
                                  <option value="">Select Client Record</option>
                                </select>
                              </div>
                              <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                              </div>

                              <div class="col-sm-6">
                                <label for="lastName" class="form-label">Email</label>
                                <input type="text" class="form-control" required="" readonly>
                                <div class="invalid-feedback">
                                  Valid last name is required.
                                </div>
                              </div>

                              <div class="col-sm-6">
                                <label for="lastName" class="form-label">Mobile Phone Number</label>
                                <input type="text" class="form-control" required="" readonly>
                                <div class="invalid-feedback">
                                  Valid last name is required.
                                </div>
                              </div>
                            </div>
                            <!-- End Returning Client -->

                            <div v-if="showNewClient" class="row">
                              <div class="col-12">
                                <div class="form-group form-focus focused mb-0">
                                  <label class="focus-label">Client ID</label>
                                  <input class="form-control floating"  type="text" readonly>
                                </div>
                                <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                              </div>

                              <div class="col-sm-6">
                                <label for="firstName" class="form-label">Fullname</label>
                                <input type="text" class="form-control" required="">
                                <div class="invalid-feedback">
                                  Valid first name is required.
                                </div>
                              </div>

                              <div class="col-sm-6">
                                <label class="form-label">Gender</label>
                                <select class="form-control">
                                  <option value="">Select Gender</option>
                                </select>
                                <small class="form-text text-danger d-flex justify-content-left mb-0"></small>
                              </div>

                              <div class="col-sm-6">
                                <label for="firstName" class="form-label">Email</label>
                                <input type="email" class="form-control" required="">
                                <div class="invalid-feedback">
                                  Valid first name is required.
                                </div>
                              </div>

                              <div class="col-sm-6">
                                <label class="form-label">Mobile Phone Number</label>
                                <input type="text" class="form-control" required="">
                                <small class="form-text text-danger d-flex justify-content-left mb-0"></small>
                              </div>
                            </div>
                            <!-- End New Client -->
                        </div>
                        <div class="form-card  mb-5">
                          <div class="row">
                              <div class="col-9">
                                  <h2 class="fs-title h4">Fabric Details:</h2>
                              </div>
                              <div class="col-3">
                                  <h2 class="steps">Fabric 1 - 3</h2>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="form-group form-focus focused mb-0">
                                <label class="focus-label pl-2 mb-2">Fabric Record</label>
                                <select class="form-control mt-2">
                                  <option value="">Select Fabric</option>
                                </select>
                              </div>
                              <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                            </div>
                            <div class="col-sm-6">
                              <label for="lastName" class="form-label">Unit Price (NGN)</label>
                              <input type="number" class="form-control" required="" readonly>
                              <div class="invalid-feedback">
                                Valid last name is required.
                              </div>
                            </div>

                            <div class="col-sm-6">
                              <label for="lastName" class="form-label">Fabric Name</label>
                              <input type="text" class="form-control" required="" readonly>
                              <div class="invalid-feedback">
                                Valid last name is required.
                              </div>
                            </div>

                            <div class="col-sm-6">
                              <label for="lastName" class="form-label">Extra Information</label>
                              <textarea class="form-control" required=""></textarea>
                              <div class="invalid-feedback">
                                Valid last name is required.
                              </div>
                            </div>

                            <div class="col-sm-6">
                              <label for="lastName" class="form-label">Fabric Image</label>
                              <input type="file" class="form-control" accept="image/*" required>
                              <div class="invalid-feedback">
                                Valid last name is required.
                              </div>
                            </div>

                            <div class="col-sm-6">
                              <label for="firstName" class="form-label">Quantity (Yards)</label>
                              <input type="number" class="form-control" required="">
                              <div class="invalid-feedback">
                                Valid first name is required.
                              </div>
                            </div>

                            <div class="col-sm-6">
                              <label class="form-label">Amount (NGN)</label>
                              <input type="number" class="form-control" required="">
                              <small class="form-text text-danger d-flex justify-content-left mb-0"></small>
                            </div>

                            <div class="col-sm-4">
                              <label class="form-label">Cart Fabric Count</label>
                              <input type="text" class="form-control text-center" value="0" readonly>
                            </div>

                            <div class="col-sm-4">
                              <div class="form-group">
                                <label class="form-label text-dark">.</label>
                                <button class="btn btn-secondary btn-lg btn-block">View Cart Fabric</button>
                              </div>
                            </div>

                            <div class="col-sm-4">
                              <div class="form-group">
                                <label class="form-label text-dark">.</label>
                                <button class="btn btn-success btn-lg btn-block">Add to Cart</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <input @click.prevent="nextButtonClicked($event)" type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Fabric Measurement Details:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Measurments 1 - 3</h2>
                                </div>
                            </div> 
                            
                            <div class="row">
                                <div class="col-sm-4">
                                  <div class="row">
                                    <div class="col-12">
                                      <h4 class="h4 theme-text-color">Fabric's Attire Designs</h4>
                                    </div>
                                    <div class="col-12">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label pl-2 mb-2">Attire</label>
                                        <select class="form-control mt-2">
                                          <option value="">Select Attire</option>
                                        </select>
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-12">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">If Others (Attire), Please Specifiy ...</label>
                                        <input type="text" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-12">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label pl-2 mb-2">Trouser Option</label>
                                        <select class="form-control mt-2">
                                          <option value="">Select Trouser Option</option>
                                        </select>
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-12">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">If Others (Trouser Option), Please Specifiy ...</label>
                                        <input type="text" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-12">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label pl-2 mb-2">Add Accessories</label>
                                        <select class="form-control mt-2">
                                          <option value="">Select Accessory Item</option>
                                        </select>
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-12">
                                      <ul class="list-group">
                                        <li class="row">
                                          <span class="col-7 text-left h4 mt-3 text-success">Accessory Item</span>
                                          <span class="col-5 text-right h4 mt-3 text-success">Price (NGN)</span>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                  <div class="row">
                                    <div class="col-12">
                                      <h4 class="h4 theme-text-color">Fabric Measurement Details</h4>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Head Size</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Agbada Shoulder</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Agbada Length</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Shoulder</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Chest</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Neck</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Round Sleeve</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Sleeve Length</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Forearm</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Cloth Length</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Cuff/Wrist</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Tommy</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Waist</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Seat</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Laps/Thigh</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Knee</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                  <div class="row">
                                    <div class="col-12">
                                      <div class="form-check d-flex justify-content-end">
                                        <input class="form-check-input" type="checkbox" value="" style="display: inline-block !important; width: 30px !important;">
                                        <label class="form-check-label text-secondary pr-4">
                                          <strong>Default Measurement &nbsp;</strong>
                                        </label>
                                      </div>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Calf</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Trouser Length</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Trouser Base</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <label class="focus-label text-black">...</label>
                                    </div>
                                     <div class="col-12">
                                      <h3 class="h4 theme-text-color">Financial Commitment</h3>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Fabric Cost (NGN)</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Accessories Cost (NGN)</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Designer's Charges (NGN)</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group form-focus focused mb-0">
                                        <label class="focus-label mb-2">Sub Total (NGN)</label>
                                        <input type="number" class="form-control mt-2" required="">
                                      </div>
                                      <small class="form-text text-danger d-flex justify-content-left ml-0 mb-3"></small>
                                    </div>
                                    <div class="col-6">
                                      <!-- Something can be added here!!! -->
                                    </div>
                                    <div class="col-12">
                                      <label for="lastName" class="form-label">Client's Note and Special Feature</label>
                                      <textarea class="form-control" required="" style="height: 140px;"></textarea>
                                      <div class="invalid-feedback">
                                        Valid last name is required.
                                      </div>
                                    </div>
                                    <div class="col-12">
                                      <div class="form-group">
                                        <button class="btn btn-success btn-block">Add Measurement</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div> 
                        </div> 
                        <input @click.prevent="nextButtonClicked($event)" type="button" name="next" class="next action-button" value="Next" /> 
                        <input @click.prevent="previousButtonClicked($event)" type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset style="background: #ffffff;">
                        <div class="form-card">
                            <div class="row">
                              <h3 class="h2 text-center col-12 pt-5">Ode Luxury Tailors</h3>
                              <h3 class="h4 text-center col-12">TRANSACTION SUMMARY</h3>
                            </div>

                            <div class="row ml-5 mr-5">
                              <h3 class="h4 text-left col-12"><strong>Transaction Details</strong></h3>
                              <div class="col-12">
                                <table class="mb-4">
                                  <tbody>
                                    <tr>
                                      <th class="title">Transaction Ref</th>
                                      <td class="cell-value">0000000000000000000000000000000000000000000</td>
                                    </tr>
                                    <tr>
                                      <th class="title">Transaction Date</th>
                                      <td class="cell-value">07/03/2021</td>
                                    </tr>
                                    <tr>
                                      <th class="title">Pick-up Date</th>
                                      <td class="cell-value">13/03/2021</td>
                                    </tr>
                                    <tr>
                                      <th class="title">Number of Fabric(s)</th>
                                      <td class="cell-value">3 pieces</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>

                            <div class="row ml-5 mr-5">
                              <h3 class="h4 text-left col-12"><strong>Client Details</strong></h3>
                              <div class="col-12">
                                <table class="mb-4">
                                  <tbody>
                                    <tr>
                                      <th class="title">Fullname</th>
                                      <td class="cell-value">Akugbe Ode</td>
                                    </tr>
                                    <tr>
                                      <th class="title">Email</th>
                                      <td class="cell-value">akugbeode@gmail.com</td>
                                    </tr>
                                    <tr>
                                      <th class="title">Mobile No.</th>
                                      <td class="cell-value">07052858059</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>

                            <div class="row ml-5 mr-5">
                              <h3 class="h4 text-left col-12"><strong>Order Summary</strong></h3>
                              <div class="col-12">
                                <div v-for="(fabric, fabricIndex) in transaction.fabrics" :key="fabric.fabricID" style="padding: 0px; width: 100%; margin-bottom: 60px;">
                                  <h4 class="h4 ml-2 mt-2 text-dark"><strong>{{fabricIndex+1}}). {{fabric.name}}</strong></h4>
                                  <table class="col-12 ml-4 mb-4">
                                    <tbody>
                                      <tr style="width: 200px !important;">
                                        <td class="col-12" style="padding: 0px;">
                                          <div class="tr">
                                            <span class="title">Price</span>
                                            <span class="cell-value"><strong>NGN</strong> {{fabric.price}}</span>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="col-12" style="padding: 0px;">
                                          <div class="tr">
                                            <span class="title">Attire</span>
                                            <span class="cell-value">{{fabric.attire}}</span>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="col-12" style="padding: 0px;">
                                          <div class="tr">
                                            <span class="title">Trouser Option</span>
                                            <span class="cell-value">{{fabric.trouserOption}}</span>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr v-if="fabric.accessories.length > 0">
                                        <td class="col-12" style="padding: 0px;">
                                          <h4 class="h4 ml-2 mt-2 text-dark"><strong>Accessories</strong></h4>
                                          <div class="tr" v-for="(accessory, indexAccessory) in fabric.accessories" :key="indexAccessory">
                                            <span class="title">{{accessory.name}}</span>
                                            <span class="cell-value"><strong>NGN</strong> {{accessory.price}}</span>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="col-12" style="padding: 0px;">
                                          <h4 class="h4 ml-2 mt-2 text-dark"><strong>Measurement</strong></h4>
                                          <table class="measurement" style="width: 96%;">
                                            <tbody>
                                              <tr>
                                                <th>Head Size</th>
                                                <td class="text-center">{{fabric.measurement.headSize}}</td>
                                                <th>Agbada Shoulder</th>
                                                <td class="text-center">{{fabric.measurement.agbadaShoulder}}</td>
                                                <th>Agbada Length</th>
                                                <td class="text-center">{{fabric.measurement.agbadaLength}}</td>
                                              </tr>
                                              <tr>
                                                <th>Shoulder</th>
                                                <td class="text-center">{{fabric.measurement.shoulder}}</td>
                                                <th>Chest</th>
                                                <td class="text-center">{{fabric.measurement.chest}}</td>
                                                <th>Neck</th>
                                                <td class="text-center">{{fabric.measurement.neck}}</td>
                                              </tr>
                                              <tr>
                                                <th>Round Sleeve</th>
                                                <td class="text-center">{{fabric.measurement.roundSleeve}}</td>
                                                <th>Sleeve Length</th>
                                                <td class="text-center">{{fabric.measurement.sleeveLength}}</td>
                                                <th>Forearm</th>
                                                <td class="text-center">{{fabric.measurement.forearm}}</td>
                                              </tr>
                                              <tr>
                                                <th>Cloth Length</th>
                                                <td class="text-center">{{fabric.measurement.clothLength}}</td>
                                                <th>Cuff/Wrist</th>
                                                <td class="text-center">{{fabric.measurement.cuffWrist}}</td>
                                                <th>Tommy</th>
                                                <td class="text-center">{{fabric.measurement.tommy}}</td>
                                              </tr>
                                              <tr>
                                                <th>Waist</th>
                                                <td class="text-center">{{fabric.measurement.waist}}</td>
                                                <th>Seat</th>
                                                <td class="text-center">{{fabric.measurement.seat}}</td>
                                                <th>Laps/Thigh</th>
                                                <td class="text-center">{{fabric.measurement.lapsThigh}}</td>
                                              </tr>
                                              <tr>
                                                <th>Knee</th>
                                                <td class="text-center">{{fabric.measurement.knee}}</td>
                                                <th>Calf</th>
                                                <td class="text-center">{{fabric.measurement.calf}}</td>
                                                <th>Trouser Length</th>
                                                <td class="text-center">{{fabric.measurement.trouserLength}}</td>
                                              </tr>
                                              <tr>
                                                <th>Trouser Base</th>
                                                <td class="text-center">{{fabric.measurement.trouserBase}}</td>
                                                <th class="text-white">...</th>
                                                <td class="text-white">...</td>
                                                <th class="text-white">...</th>
                                                <td class="text-white">...</td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="col-12" style="padding: 0px;">
                                          <div class="tr mt-3">
                                            <span class="title">Sub Total</span>
                                            <span class="cell-value"><strong>NGN</strong> {{ computeFabricSubTotal(fabric) }}</span>
                                          </div>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                            <div class="row mt-4">
                               <div class="col-6 offset-6">
                                 <table class="ml-4 mb-4">
                                    <tbody>
                                      <tr>
                                        <td class="col-12" style="padding: 0px;">
                                          <div class="tr">
                                            <span class="h4 title">Order Total</span>
                                            <span class="h4 cell-value"><strong>NGN</strong> {{ transaction.orderTotal }}</span>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="col-12" style="padding: 0px;">
                                          <div class="tr">
                                            <span class="h4 title">VAT (7.5%)</span>
                                            <span class="h4 cell-value"><strong>NGN</strong> {{ transaction.vatOnOrderTotal }}</span>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="col-12" style="padding: 0px;">
                                          <div class="tr">
                                            <span class="h4 title">Total</span>
                                            <span class="h4 cell-value"><strong>NGN</strong> {{ transaction.total }}</span>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="col-12" style="padding: 0px;">
                                          <div class="tr">
                                            <span class="h4 title">Deposit</span>
                                            <span class="cell-value">
                                              <div style="display: flex !important; flex-direction: row !important; align-items: center !important;">
                                                <span class="h4" style="padding: 0px 0px 0px 7px; margin: 0px;"><strong>NGN</strong></span>
                                                <input @keypress="numbersOnly($event)" @input.prevent="computeBalance" v-model="transaction.deposit" type="number" class="h4" style="padding: 2px 0px 2px 5px; margin: 0px; background: inherit; width: 70%; max-width: 250px; color: #000000;">
                                              </div>
                                            </span>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="col-12" style="padding: 0px;">
                                          <div class="tr">
                                            <span class="h4 title">Balance</span>
                                            <span class="h4 cell-value"><strong>NGN</strong> {{ transaction.balance }}</span>
                                          </div>
                                        </td>
                                      </tr>
                                    </tbody>
                                </table>
                               </div>
                            </div>
                        </div>
                        <input type="button" name="next" class="process-transaction action-button" value="Process Transaction" /> 
                        <input @click.prevent="previousButtonClicked($event)" type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from "vuex";

  export default {
    name: 'ServiceUserRegisterNewTransaction',

    data() {
      return {
        selectedClientOption: "returning client",

        fieldSetElements: null,
        currentFS: null,
        nextFS: null,
        previousFS: null,
        opacity: null,
        steps: null,
        current: 1,


        transaction: {
          fabrics: [
            {
              fabricID: '000000000000000000000000000000000000000000000',
              name: 'Ankara Blueprint',
              price: 5000,
              attire: 'Agbada',
              trouserOption: 'Shokoto',
              accessories: [
                {
                  name: 'Agbada Cap',
                  price: 1500
                },{
                  name: 'Embrodry',
                  price: 1500
                }
              ],
              measurement: {
                headSize: 20,
                agbadaShoulder: 20,
                agbadaLength: 20,
                shoulder: 20,
                chest: 20,
                neck: 20,
                roundSleeve: 20,
                sleeveLength: 20,
                forearm: 20,
                clothLength: 20,
                cuffWrist: 20,
                tommy: 20,
                waist: 20,
                seat: 20,
                lapsThigh: 20,
                knee: 20,
                calf: 20,
                trouserLength: 20,
                trouserBase: 20
              },
              designerCharges: 20000,
              clientNoteAndSpecialFeature: 'Client notes.'
            },{
              fabricID: '000000000000000000000000000000000000000000001',
              name: 'Ankara Blueprint',
              price: 5000,
              attire: 'Agbada',
              trouserOption: 'Shokoto',
              accessories: [
                {
                  name: 'Agbada Cap',
                  price: 1500
                },{
                  name: 'Embrodry',
                  price: 1500
                }
              ],
              measurement: {
                headSize: 20,
                agbadaShoulder: 20,
                agbadaLength: 20,
                shoulder: 20,
                chest: 20,
                neck: 20,
                roundSleeve: 20,
                sleeveLength: 20,
                forearm: 20,
                clothLength: 20,
                cuffWrist: 20,
                tommy: 20,
                waist: 20,
                seat: 20,
                lapsThigh: 20,
                knee: 20,
                calf: 20,
                trouserLength: 20,
                trouserBase: 20
              },
              designerCharges: 20000,
              clientNoteAndSpecialFeature: 'Client notes.'
            }
          ],
          orderTotal: 0,
          vatOnOrderTotal: 0,
          total: 0,
          deposit: "",
          balance: 0
        }
      }
    },

    computed: {
      ...mapGetters([ "loggedUser" ]),

      showReturningClient() {
        return this.selectedClientOption === "returning client";
      },

      showNewClient() {
        return this.selectedClientOption === "new client";
      }
    },

    methods: {
      nextButtonClicked(e) {
        this.currentFS = e.target.parentNode;
        this.nextFS = e.target.parentNode.nextElementSibling;

        document.querySelectorAll("#progressbar li")[this.getIndexOfFieldsetElement(this.nextFS)].classList.add("active");

        this.current = this.getIndexOfFieldsetElement(this.nextFS) + 1;
        this.setProgressBar(this.current);

        this.nextFS.style.display = "block";
        this.currentFS.style.display = "none";

        this.processTransactionNumericProperties()
      },

      getIndexOfFieldsetElement(fieldset) {
        let targetIndex = -1;
        for (let i=0; i<this.fieldSetElements.length; i++) {
          if (this.fieldSetElements[i] === fieldset) {
            targetIndex = i;
          }
        }
        return targetIndex;
      },

      previousButtonClicked(e) {
        this.currentFS = e.target.parentNode;
        this.previousFS = e.target.parentNode.previousElementSibling;

        document.querySelectorAll("#progressbar li")[this.getIndexOfFieldsetElement(this.currentFS)].classList.remove("active");

        this.current = this.getIndexOfFieldsetElement(this.currentFS);
        this.setProgressBar(this.current);

        this.previousFS.style.display = "block";
        this.currentFS.style.display = "none";
      },

      setProgressBar(currentFSStep) {
        let percent = (parseFloat(100/this.steps) * currentFSStep).toFixed();
        const progressBar = document.querySelector(".progress-bar");
        if (progressBar) {
          progressBar.style.width = percent+"%";
        }
      },

      attemptTransactionProcessing() {

      },

      computeFabricSubTotal(fabric) {
        return parseFloat(10000).toFixed(2);
      },

      getTransactionOrderTotal() {
        this.transaction.orderTotal = parseFloat(100000).toFixed(2);
      },

      getComputedVATCharges() {
        this.transaction.vatOnOrderTotal = ((7.5/100) * parseFloat(this.transaction.orderTotal)).toFixed(2);
      },

      getTotal() {
        this.transaction.total = (parseFloat(this.transaction.orderTotal) + parseFloat(this.transaction.vatOnOrderTotal)).toFixed(2);
      },

      setBalance() {
        try {
          if ((parseFloat(this.transaction.total) > 0) && (!this.transaction.deposit)) {
            this.transaction.balance = parseFloat(this.transaction.total).toFixed(2)
          } else if ((parseFloat(this.transaction.total) > 0) && (parse(this.transaction.deposit) > 0)) {
            this.computeBalance()
          }
        } catch (ex) {
          this.transaction.balance = parseFloat(this.transaction.balance).toFixed(2)
        }
      },

      computeBalance() {
        this.transaction.balance = parseFloat(this.transaction.total) - parseFloat(this.transaction.deposit);

        if (!this.transaction.deposit) {
          this.transaction.balance = parseFloat(this.transaction.total).toFixed(2)
        } else if (this.transaction.balance > 0) {
          this.transaction.balance = parseFloat(this.transaction.balance).toFixed(2);
        } else {
          this.transaction.balance = parseFloat(0).toFixed(2);
        }
      },

      numbersOnly(e) {
        let char = String.fromCharCode(e.keyCode);
        if(/^\d+$/.test(char)) {
          return true;
        } else e.preventDefault();
      },

      processTransactionNumericProperties() {
        this.getTransactionOrderTotal();
        this.getComputedVATCharges();
        this.getTotal();
        this.setBalance();
      }
    },

    mounted() {
      this.fieldSetElements = document.querySelectorAll("fieldset");

      this.steps = this.fieldSetElements.length;

      this.setProgressBar(this.current);
    },

    created() {
      EventBus.$emit('active-menu-label-updated', '');
      this.processTransactionNumericProperties();
    }
  }
</script>

<style lang="scss" scoped>

  @import url("../../../../css/style.css");
  @import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css");

  .content {
    background: transparent;
  }

  .page-title {
    color: #d4af37;
  }

  #heading {
    text-transform: uppercase;
    color: #d4af37;
    font-weight: normal
}

#msform {
    text-align: center;
    position: relative;
    margin-top: 20px
}

#msform fieldset {
    background: #000000;
    border: 0 none;
    border-radius: 0px;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding: 20px;
    position: relative;
    -webkit-transition: all 0.4s ease; -moz-transition: all 0.4s ease; transition: all 0.4s ease;
}

.form-card {
    text-align: left
}

#msform fieldset:not(:first-of-type) {
    display: none
}

#msform label { color: #aaaaaa; }

#msform select,
#msform input,
#msform textarea {
    padding: 8px 15px 8px 15px;
    border: 1px solid #ccc;
    border-radius: 0px;
    margin-bottom: 25px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    color: #FFFFFF;
    background-color: #000000;
    font-size: 16px;
    letter-spacing: 1px
}

#msform select:focus,
#msform input:focus,
#msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #d4af37;
    outline-width: 0
}

#msform .action-button {
    width: 100px;
    background: #d4af37;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 0px 10px 5px;
    float: right
}

#msform  .process-transaction {
  width: auto;
}

#msform .action-button:hover,
#msform .action-button:focus {
    background-color: #f4cf67;
    color: #945f07;
}

#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px 10px 0px;
    float: right
}

#msform .action-button-previous:hover,
#msform .action-button-previous:focus {
    background-color: #000000
}

.card {
    z-index: 0;
    border: none;
    position: relative
}

.fs-title {
    font-size: 25px;
    color: #d4af37;
    margin-bottom: 15px;
    font-weight: normal;
    text-align: left
}

.purple-text {
    color: #d4af37;
    font-weight: normal
}

.steps {
    font-size: 25px;
    color: gray;
    margin-bottom: 10px;
    font-weight: normal;
    text-align: right
}

.fieldlabels {
    color: gray;
    text-align: left
}

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey
}

#progressbar .active {
    color: #d4af37
}

#progressbar li {
    list-style-type: none;
    font-size: 15px;
    width: 33.33%;
    float: left;
    position: relative;
    font-weight: 400
}

#progressbar #transaction-details:before {
    font-family: "FontAwesome";
    content: "1";
    font-weight: 900;
    color: #000000;
}

#progressbar #fabric-measurement-details:before {
    font-family: "FontAwesome";
    content: "2";
    font-weight: 900;
    color: #000000;
}

#progressbar #transaction-summary:before {
    font-family: "FontAwesome";
    content: "3";
    font-weight: 900;
    color: #000000;
}

#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 20px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1
}

#progressbar li.active:before,
#progressbar li.active:after {
  background: #d4af37
}

.progress {
  height: 20px;
  border-radius: 0px;
}

.progress-bar {
    background-color: #d4af37
}

.theme-text-color {
  color: #d4af37;
}

.text-black {
  color: #000000 !important;
}

.fit-image {
    width: 100%;
    object-fit: cover
}

.card {
    background-color: transparent;
}

.floating {
  background: black;
}

tbody {
  color: #000000;
}

th {
  padding-left: 20px;
  width: 200px !important;
}

td {
  padding-left: 20px;
}

th.title {
  width: 200px !important;
}

td.cell-value {
  width: calc(100% - 200px) !important;
}

// table, th, td {
//   border: 1px solid black;
// }

.measurement {
  border: 1px solid black;

  th, td {
    border: 1px solid black;
  }
}

td.text-center {
  padding: 0px;
  width: 100px;
}

div.tr {
  width: 96%;

  display: flex;
  flex-direction: row;

  .title {
    width: 200px;
    font-weight: 900;
    padding-left: 20px;
  }

  .cell-value {
    min-width: 200px;
    padding-left: 20px;
  }
}
</style>