var mMail= {
    init:function() {
        new mOffcanvas("m_mail_aside", {
            overlay:!0, baseClass:"m-mail__aside", closeBy:"m_mail_aside_close_btn", toggleBy: {
                target: "m_mail_aside_toggle_btn", state: "m-mail-aside-toggle--active"
            }
        }
        ),
        new mMenu("m_mail_aside_menu", {
            submenu: {
                desktop: "dropdown", tablet: "accordion", mobile: "accordion"
            }
            , accordion: {
                slideSpeed: 200, autoScroll: !0, expandAll: !1
            }
        }
        )
    }
}

;
$(document).ready(function() {
    !1===mUtil.isAngularVersion()&&mMail.init()
}

);