function check() {
	valid = true;

        if (document.addsm.lat.value <45) 
        {
                alert ( "Будь ласка, введіть правильну широту" );
                valid = false;
        }
        if (document.addsm.lat.value >50) 
        {
                alert ( "Будь ласка, введіть правильну широту" );
                valid = false;
        }
        
        if (document.addsm.lng.value <20) 
        {
                alert ( "Будь ласка, введіть правильну довготу" );
                valid = false;
        }
        
         if (document.addsm.lng.value >30) 
        {
                alert ( "Будь ласка, введіть правильну довготу" );
                valid = false;
        }

        return valid;

	
}