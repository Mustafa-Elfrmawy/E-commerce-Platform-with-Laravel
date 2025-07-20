@if (Session::has('message'))
    <div class="warning-alert" style="
        background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
        border: 2px solid #ffc107;
        border-radius: 12px;
        padding: 20px;
        margin: 15px 0;
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.15);
        position: relative;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        animation: slideIn 0.3s ease-out;
    ">
        <button type="button" class="close-btn" data-dismiss="alert" aria-label="Close" style="
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 24px;
            color: #856404;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        " onmouseover="this.style.backgroundColor='rgba(133, 100, 4, 0.1)'; this.style.transform='scale(1.1)'" onmouseout="this.style.backgroundColor='transparent'; this.style.transform='scale(1)'">
            <span aria-hidden="true">&times;</span>
        </button>
        
        <div style="display: flex; align-items: center; margin-bottom: 10px;">
            <div style="
                background: #ffc107;
                color: #856404;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 15px;
                box-shadow: 0 2px 8px rgba(255, 193, 7, 0.3);
            ">
                <i class="fa fa-exclamation-triangle" style="font-size: 18px;"></i>
            </div>
            <h4 style="
                color: #856404;
                margin: 0;
                font-size: 18px;
                font-weight: 600;
                letter-spacing: 0.5px;
            ">Alert!</h4>
        </div>
        
        <div style="
            color: #856404;
            font-size: 15px;
            line-height: 1.5;
            margin-left: 55px;
            font-weight: 500;
        ">
            {{ Session::get('message') }}
        </div>
    </div>
@endif



@if (Session::has('success'))
    <div class="success-alert" style="
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        border: 2px solid #28a745;
        border-radius: 12px;
        padding: 20px;
        margin: 15px 0;
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.15);
        position: relative;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        animation: slideIn 0.3s ease-out;
    ">
        <button type="button" class="close-btn" data-dismiss="alert" aria-label="Close" style="
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 24px;
            color: #155724;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        " onmouseover="this.style.backgroundColor='rgba(21, 87, 36, 0.1)'; this.style.transform='scale(1.1)'" onmouseout="this.style.backgroundColor='transparent'; this.style.transform='scale(1)'">
            <span aria-hidden="true">&times;</span>
        </button>
        
        <div style="display: flex; align-items: center; margin-bottom: 10px;">
            <div style="
                background: #28a745;
                color: white;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 15px;
                box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
            ">
                <i class="fa fa-check" style="font-size: 18px;"></i>
            </div>
            <h4 style="
                color: #155724;
                margin: 0;
                font-size: 18px;
                font-weight: 600;
                letter-spacing: 0.5px;
            ">Success!</h4>
        </div>
        
        <div style="
            color: #155724;
            font-size: 15px;
            line-height: 1.5;
            margin-left: 55px;
            font-weight: 500;
        ">
            {{ Session::get('success') }}
        </div>
    </div>
    
    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .success-alert:hover,
        .success-register-alert:hover,
        .success-password-alert:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.2) !important;
            transition: all 0.3s ease;
        }
        
        .warning-alert:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 193, 7, 0.2) !important;
            transition: all 0.3s ease;
        }
        
        .error-alert:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.2) !important;
            transition: all 0.3s ease;
        }
    </style>
@endif

@if (Session::has('successRegister'))
    <div class="success-register-alert" style="
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        border: 2px solid #28a745;
        border-radius: 12px;
        padding: 20px;
        margin: 15px 0;
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.15);
        position: relative;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        animation: slideIn 0.3s ease-out;
    ">
        <button type="button" class="close-btn" data-dismiss="alert" aria-label="Close" style="
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 24px;
            color: #155724;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        " onmouseover="this.style.backgroundColor='rgba(21, 87, 36, 0.1)'; this.style.transform='scale(1.1)'" onmouseout="this.style.backgroundColor='transparent'; this.style.transform='scale(1)'">
            <span aria-hidden="true">&times;</span>
        </button>
        
        <div style="display: flex; align-items: center; margin-bottom: 10px;">
            <div style="
                background: #28a745;
                color: white;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 15px;
                box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
            ">
                <i class="fa fa-check-circle" style="font-size: 18px;"></i>
            </div>
            <h4 style="
                color: #155724;
                margin: 0;
                font-size: 18px;
                font-weight: 600;
                letter-spacing: 0.5px;
            ">Registration Successful Sign In Now!</h4>
        </div>
        
        <div style="
            color: #155724;
            font-size: 15px;
            line-height: 1.5;
            margin-left: 55px;
            font-weight: 500;
        ">
            {{ Session::get('successRegister') }}
        </div>
    </div>
@endif
@if (Session::has('successChangePassword'))
    <div class="success-password-alert" style="
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        border: 2px solid #28a745;
        border-radius: 12px;
        padding: 20px;
        margin: 15px 0;
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.15);
        position: relative;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        animation: slideIn 0.3s ease-out;
    ">
        <button type="button" class="close-btn" data-dismiss="alert" aria-label="Close" style="
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 24px;
            color: #155724;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        " onmouseover="this.style.backgroundColor='rgba(21, 87, 36, 0.1)'; this.style.transform='scale(1.1)'" onmouseout="this.style.backgroundColor='transparent'; this.style.transform='scale(1)'">
            <span aria-hidden="true">&times;</span>
        </button>
        
        <div style="display: flex; align-items: center; margin-bottom: 10px;">
            <div style="
                background: #28a745;
                color: white;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 15px;
                box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
            ">
                <i class="fa fa-key" style="font-size: 18px;"></i>
            </div>
            <h4 style="
                color: #155724;
                margin: 0;
                font-size: 18px;
                font-weight: 600;
                letter-spacing: 0.5px;
            ">Password Changed Successfully!</h4>
        </div>
        
        <div style="
            color: #155724;
            font-size: 15px;
            line-height: 1.5;
            margin-left: 55px;
            font-weight: 500;
        ">
            {{ Session::get('successChangePassword') }}
        </div>
    </div>
@endif


@if (Session::has('errorFindProduct'))
    <div class="error-alert" style="
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        border: 2px solid #dc3545;
        border-radius: 12px;
        padding: 20px;
        margin: 15px 0;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.15);
        position: relative;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        animation: slideIn 0.3s ease-out;
    ">
        <button type="button" class="close-btn" data-dismiss="alert" aria-label="Close" style="
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 24px;
            color: #721c24;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        " onmouseover="this.style.backgroundColor='rgba(114, 28, 36, 0.1)'; this.style.transform='scale(1.1)'" onmouseout="this.style.backgroundColor='transparent'; this.style.transform='scale(1)'">
            <span aria-hidden="true">&times;</span>
        </button>
        
        <div style="display: flex; align-items: center; margin-bottom: 10px;">
            <div style="
                background: #dc3545;
                color: white;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 15px;
                box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
            ">
                <i class="fa fa-times" style="font-size: 18px;"></i>
            </div>
            <h4 style="
                color: #721c24;
                margin: 0;
                font-size: 18px;
                font-weight: 600;
                letter-spacing: 0.5px;
            ">Error!</h4>
        </div>
        
        <div style="
            color: #721c24;
            font-size: 15px;
            line-height: 1.5;
            margin-left: 55px;
            font-weight: 500;
        ">
            {{ Session::get('errorFindProduct') }}
        </div>
    </div>
@endif
