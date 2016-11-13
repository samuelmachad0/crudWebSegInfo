	function encrypt(msg) {
		var rsa = new RSAKey();
		rsa.setPublic('81cc14ebb140018e702e21c4207e8dfde5af3d7af5b50be396682503eadd4852c229080e052f01f874c38fe22e5cbbde12a1ad6253c5ca2094fb7fe7e6a953a3', '010001');
		return rsa.encrypt(msg);
	}