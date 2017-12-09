  <form action="../../user.php" method="post" class="form-horizontal" role="form">
          <fieldset style="min-width: 200px; margin: 10px;">
            <legend>
              登入
            </legend>
            <div class="form-group">
              <label class="col-md-4 control-label">
                帳號
              </label>
              <div class="col-md-8">
                <input type="text" name="uname"  id="uname" placeholder="請輸入帳號"  class="form-control" />
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label">
                密碼
              </label>
              <div class="col-md-8">
              <input type="password" name="pass" id="pass" placeholder="請輸入密碼" class="form-control" />
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label">
              </label>
              <div class="col-md-8">
                <!-- <input type="hidden" name="xoops_redirect" value="/~kyc/" /> -->
                <input type="hidden" name="xoops_redirect" value="/" />
                <input type="hidden" name="rememberme" value="On" />
                <input type="hidden" name="op" value="login" />
                <input type="hidden" name="xoops_login" value="1"/>
                <button type="submit" class="btn btn-primary btn-block">登入</button>
              </div>
            </div>
          </fieldset>
        </form>
