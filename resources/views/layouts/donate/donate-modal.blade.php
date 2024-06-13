
<div class="modal fade" id="donateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="sleeve">
          <div class="credit-card selected" style="background: #252525">
              <div class="card-company" style="left: 20px;"></div>
              <div class="card-number" style="margin-top: 74px;">
                  <div id="cardno" class="digit-group">XXXX XXXX XXXX XXXX</div>
              </div>
              <div class="card-expire"><span class="card-text" style="color: darkgrey;">CVV &nbsp;</span>
                  <p class="card-p-text">000</p> <span class="card-text" style="color: darkgrey;">Expires
                      &nbsp;</span>
                  <div id="date"> MM/YY</div>
              </div>
              <div id="holdername" class="card-holder">e.g. John Doe</div>
          </div>
      </div>
      <form name="stripe_form" id="stripe_form" onsubmit="return false">
          {{ csrf_field() }}
          <div class="modal-body">
              <div id="error-div"></div>
              <div class="form-group">
                <input type="hidden" name="causeId" id="causeId">
                  <label for="nameoncard">Name on card</label>
                  <input type="text" class="form-control" id="nameoncard" name="nameoncard"
                      placeholder="Name on card">
              </div>
              <div class="form-group">
                  <label for="cardnumber">Card number</label>
                  <input type="text" class="form-control" id="cardnumber" name="cardnumber"
                      placeholder="Card number">
              </div>
              <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount"
                    placeholder="Enter amount">
            </div>
              <div class="row">
                  <div class="col">
                      <div class="form-group">
                          <label for="expiryyear">Expiry Year</label>
                          <input type="text" class="form-control" id="expiryyear" name="expiryyear"
                              placeholder="YY">
                      </div>
                  </div>
                  <div class="col">

                      <div class="form-group">
                          <label for="expirymonth">Expiry Month</label>
                          <input type="text" class="form-control" id="expirymonth" name="expirymonth"
                              placeholder="MM">
                      </div>
                  </div>
                  

              </div>
              <div class="form-group">
                  <label for="securitycode">Security code</label>
                  <input type="password" class="form-control" id="securitycode" name="securitycode"
                      placeholder="Security code">
              </div>

              <div class="pay cart-btn mt-100">
                  <a href="JavaScript:void(0)" class="btn btn-primary w-100">Pay</a>
              </div>
          </div>
      </form>

      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> --}}
    </div>
  </div>
</div>