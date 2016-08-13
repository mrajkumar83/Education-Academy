// JavaScript Document

jQuery(document).ready(function($){
                        $("#enquiry_dob").datepicker({
                        changeMonth: true,
                        changeYear: true,
						yearRange: '-50y:c+nn',
            			maxDate: '-15y',
                        dateFormat: "mm/dd/yy"
                    });
					$("#enquiry_crtdate").datepicker({
                        changeMonth: true,
                        changeYear: true,
                        dateFormat: "mm/dd/yy"
                    });
					$("#enquiry_call1_date").datepicker({
                        changeMonth: true,
                        changeYear: true,
                        dateFormat: "mm/dd/yy"
                    });
					$("#enquiry_call2_date").datepicker({
                        changeMonth: true,
                        changeYear: true,
                        dateFormat: "mm/dd/yy"
                    });
                });
