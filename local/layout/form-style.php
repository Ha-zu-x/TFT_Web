<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">  
<style>
	.modal-dialog {
		max-width: 450px;
	}
	.modal-header-title,
	.modal-header-action,
	.modal-footer-action {
		display: flex;
	}
	.modal-header-title {
		justify-content: space-between;
		font-weight: 600;
		font-size: 18px;
	}
	.modal-header-title span {
		width: 100%;
		font-size: 25px;
		text-align: center;
	}
	.modal-header-title .close {
		display: block;
	}
	.modal-header-action {
		justify-content: center;
		align-items: center;
	}
	.modal-header-action a {
		padding: 8px;
	}
	.modal-header-action a,
	.modal-footer-action a {
		color: #337ab7;
	}

	.modal-footer-action {
		justify-content: space-between;
		margin-bottom: 10px;
		font-size: 14px;
	}
	
	#custom-form{
		background-color: #fff;
		border-color: #fff;
		padding: 0;
		margin: 0;

	}
	.mg-contact-form-input {
		position: relative;
		display: flex;
		align-items: center;
		flex-wrap: wrap;
	}
	.mg-contact-form-input input {
		padding-inline-start: 2.5rem;
		padding-inline-end: 3rem;
	}
	.mg-contact-form-input i{
		position: absolute;
		opacity: 0.5;
		left: 14px;
		top: 16px;
		font-size: 12px;
	}
	.mg-contact-form-input,
	.modal-footer-action div {
		padding: 6px;
	}
	.modal-footer .btn-info {
		border-radius: 5px;
		font-size: 16px;
	}
	.modal-footer .btn-info:focus {
		outline: none;
		border-color: none;
	}
	.toggle-password {
		position: absolute;
		font-size: 12px;
		color: #000;
		opacity: 1;
		right: 20px;
		top: 18px;
		z-index: 2;
	}

	.toggle-password.disabled{
		opacity: 0.3;
	}
	.modal-footer-action span:hover {
		cursor: pointer;
	}
	.text-danger {
        margin-top: 5px;
		font-size: 14px;
		color: #833433;
	}
	.inform--success,
	.inform--failed{
		font-size: 14px;
		border-radius: 5px;
		margin: 0px 6px;
		padding: 6px;
	}
	.inform--failed {
		background-color: #fad8dc;
	}
	.inform--success {
		background-color: #d1edde;
        color: #3e6342;
	}

</style>