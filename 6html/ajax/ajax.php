                        <form action="<{:U('Login/login')}>"  method="post">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed">
                                    <tr>
                                        <td height="40" width="45px">用户名</td>
                                        <td class="td" height="40" width="530"><input class="bd2" name="user_name" type="text" value="" /></td>
                                    </tr>
                                    <tr>
                                        <td height="35">密码</td>
                                        <td class="td" height="40" width="230"><input class="bd2" name="user_password" type="password" value="" /></td>
                                    </tr>
                                    <tr>
                                        <td height="45" colspan="2" align="center"><button style="left: -999px;position:absolute" id="ajaxsubmit1" name="sub" class="main_button" type="submit">submit</button><img src="images/a_r6_c2.jpg" width="288" height="48" /></td>
                                    </tr>
                                </table>
                                    <input name="__RequestVerificationToken" type="hidden" value="QZD9fCtrufFQ6_vYfhgu_EYMiLmwNuMoMP5z_GPMyAMU7BD9ILQRdX79LR4p4HUsB84V01vOPX1KrwEaHzzLqPKtAF0p7Z-3eBojzrhEBOB9kOIe-AkM0Vg3IlYH4xxJH3HKe6V7zm8WkXz0p3MOS9w8bZUWU5bABtW2DwrEM301" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div><div class="nr"></div>
            </div>
            <div style="clear:both;"></div>
        </div>    <div style="clear:both;"></div>
    </div>
    <script type="text/javascript">
        $(function(){
            $("#ajaxsubmit1").click(function(){
                $.ajax({
                    url:"<{:U('Login/login')}>",
                    type:"POST",
                    data:{name:'user_name',pwd:'user_password'},
                    error:function(){
                        alert('错误')
                    },
                    success:function(data,status){
                        alert('对的');
                    }
                })
            })
        })
    </script>