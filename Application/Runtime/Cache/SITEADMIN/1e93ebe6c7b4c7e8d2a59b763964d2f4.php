<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>用户登录</title>
    <meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/Museum/Public/static/bootstrap/css/bootstrap.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="/Museum/Public/SITEADMIN/css/login.css" media="all">

	<script type="text/javascript" src="/Museum/Public/static/jquery.min.js"></script>
	<script type="text/javascript" src="/Museum/Public/static/bootstrap/js/bootstrap.min.js"></script>

</head>

<body>
	<div class="container">

		<div class="row col-md-6 col-sm-offset-3">
			<div id="login">
				<form class="form-horizontal" action="<?php echo U('login','','');?>" role="form" method="post">
					<div class="form-group">
						<label for="username" class="col-sm-offset-1 col-sm-2 control-label">用户名:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="username" name="username" placeholder="用户名" required />
						</div>
					</div>

					<div class="form-group">
						<label for="password" class="col-sm-offset-1 col-sm-2 control-label">密 &nbsp; &nbsp;码:</label>
						<div class="col-sm-6">
							<input type="password" class="form-control" id="password" name="password" placeholder="密码"  required />
						</div>
					</div>

					<div class="form-group">
						<label for="verify" class="col-sm-offset-1 col-sm-2 control-label">验证码:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="verify" name="verify" placeholder="验证码"  required />
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-sm-offset-1 col-sm-2 control-label"></label>
						<div class="col-sm-6">
							<img src="<?php echo U('verify');?>" class="verifyimg reloadverify"/>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-7">
							<button id="submit" type="submit" class="btn btn-primary btn-login">登陆</button>
						</div>
					</div>
					<div class="form-group">
						<p class="check-tips text-danger col-sm-offset-3 col-sm-7"></p>
					</div>

				</form>
			</div>
		</div>
	</div>

<script>
	//表单提交
	$(document)
		.ajaxStart(function(){
			$("button:submit").attr("disabled", true);
		})
		.ajaxStop(function(){
			$("button:submit").attr("disabled", false);
		});

	$("form").submit(function(){
		var self = $(this);
		$.post(self.attr("action"), self.serialize(), success, "json");
		return false;

		function success(data){
			if(data.status){
				window.location.href = data.url;
			} else {
				self.find(".check-tips").text(data.info);
				//刷新验证码
				$(".reloadverify").click();
			}
		}
	});
	$(function(){
		//初始化选中用户名输入框
		$("#login").find("input[name=username]").focus();
		//刷新验证码
		var verifyimg = $(".verifyimg").attr("src");
		$(".reloadverify").click(function(){
			if( verifyimg.indexOf('?')>0){
				$(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
			}else{
				$(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
			}
		});
	});
</script>


</body>
</html>