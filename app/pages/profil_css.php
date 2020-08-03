<link rel="stylesheet" type="text/css"  href="/assets/css/smart-forms.css">
<link rel="stylesheet" type="text/css"  href="/assets/css/smart-themes/yellow.css">
<link rel="stylesheet" type="text/css"  href="/assets/css/font-awesome.min.css">

<style type="text/css">
	.container {
		max-width: 1250px;
		margin: 30px auto 30px;
		padding: 0 !important;
		width: 90%;
		background-color: #fff;
		box-shadow: 0 3px 6px rgba(0, 0, 0, 0.10), 0 3px 6px rgba(0, 0, 0, 0.10);
	}
	#header-profile {
		background: #eee;
		background-image: url("../../assets/images/pexels-photo-1731427.jpeg");
		background-repeat: no-repeat;
		background-position: center;
		background-size: cover;
		background-color: red;
		height: 250px;
	}
	#header-profile i {
		position: relative;
		cursor: pointer;
		right: -96%;
		top: 25px;
		font-size: 18px !important;
		color: #fff;
	}
	@media (max-width: 800px) {
		#header-profile {
			height: 150px;
		}
		#header-profile i {
			right: -90%;
		}
	}
	main {
		padding: 20px 20px 20px 20px;
	}
	.left {
		display: flex;
		align-items: center;
		justify-content: center;
		flex-direction: column;
	}
	.photo {
		width: 200px;
		height: 200px;
		margin-top: -120px;
		border-radius: 100px;
		border: 4px solid #fff;
	}
	.name {
		margin-top: 20px;
		margin-bottom: 5px;
		font-family: "Open Sans";
		font-weight: 600;
		font-size: 18pt;
		color: #777;
	}
	.info {
		margin-top: 5px;
		margin-bottom: 5px;
		font-family: 'Montserrat', sans-serif;
		font-size: 11pt;
		color: #aaa;
	}
	.desc {
		text-align: center;
		margin-top: 25px;
		margin: 25px 40px;
		color: #999;
		font-size: 11pt;
		font-family: "Open Sans";
		padding-bottom: 25px;
		border-bottom: 1px solid #ededed;
	}
	.social {
		margin: 5px 0 12px 0;
		text-align: center;
		display: inline-block;
		font-size: 20pt;
	}
	.social i {
		cursor: pointer;
		margin: 0 15px;
	}
	.social i:nth-child(1) {
		color: #4267b2;
	}
	.social i:nth-child(2) {
		color: #1da1f2;
	}
	.social i:nth-child(3) {
		color: #bd081c;
	}
	.social i:nth-child(4) {
		color: #36465d;
	}
	.right {
		//padding: 0 25px 0 25px !important;
	}
	.nav {
		display: inline-flex;
	}
	.nav li {
		margin: 40px 30px 0 10px;
		cursor: pointer;
		font-size: 13pt;
		text-transform: uppercase;
		font-family: 'Montserrat', sans-serif;
		font-weight: 500;
		color: #888;
	}
	.nav li:hover,
	.nav li:nth-child(1) {
		color: #999;
		border-bottom: 2px solid #999;
	}

	@media (max-width: 990px) {
		.nav {
			display: none;
		}
	}
	.gallery {
		margin-top: 35px;
	}
	.gallery div {
		/* margin-bottom: 30px; */
	}
	.gallery img {
		box-shadow: 0 3px 6px rgba(0, 0, 0, 0.10), 0 3px 6px rgba(0, 0, 0, 0.10);
		width: auto;
		height: auto;
		cursor: pointer;
		max-width: 100%;
	}
	#email, #username {
		color: #7d002a;
	}
	.infox {
		font-size: 0.9rem;
	}
	.infox > img {
		width: 2rem;
		display: none;
		box-shadow: none;
	}
	#perusahaanx {
		text-transform: uppercase;
	}
	.smart-forms .form-body {
		padding: 40px 15px;
	}
	@media screen and (max-width: 460px) {
		.container {
			width: 100%;
		}
		.smart-forms .form-body {
			padding: 40px 10px;
		}
		main {
			padding: 7px;
		}
	}
</style>
