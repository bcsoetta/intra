<link rel="stylesheet" type="text/css" href="<?php echo baseurl; ?>assets/datatables/css/datatables.css"/>

<style type="text/css">
	.appnull {
		font-size: 0.9rem;
	}
	/* http://www.responsivegridsystem.com/calculator/ */
	.grid {
		width: 85%;
		margin: 2em auto;
		/* background-color: beige; */
		display: grid;
		/* grid-template-columns: repeat(5, 1fr); */
		grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
	}

	.grid-div {
		margin: 4px;
		/* border-radius: 20px 20px 20px 0px; */
	}

	.ssoy {
		box-shadow: 0px 0px 1px 1px #607D8B;
	}

	.sson {
		box-shadow: 0px 0px 1px 1px #607D8B;
	}
	
	.grid-div img {
		width: 50%;
		height: 100%;
	}

	.grid-div a {
		margin: 10px 0 10px 0;
		display: inline-block;
		text-decoration: none;
	}

	.apptitle-ssoy {
		font-size: 1rem;
		margin-top: 10px;
		font-weight: 700;
		color: #75a63d;
	}

	.apptitle-sson {
		font-size: 1rem;
		margin-top: 10px;
		font-weight: 700;
		color: #9E9E9E;
	}

	@media screen and (max-width: 1024px) {
		.grid {
			grid-template-columns: repeat(3, 1fr);
		}
	}

	@media screen and (max-width: 768px) {
		.grid {
			grid-template-columns: repeat(3, 1fr);
		}
	}
	@media screen and (max-width: 349px) {
		.grid-div img {
			width: 100%;
			height: 100%;
		}
		.grid {
			width: 100%;
			grid-template-columns: repeat(1, 1fr);
		}
	}
	@media screen and (max-width: 460px) {
		.jconfirm .jconfirm-box-container {
			width: 90%;
    		margin: auto;
		}
	}
</style>
