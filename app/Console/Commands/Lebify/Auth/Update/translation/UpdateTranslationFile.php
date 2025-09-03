<?php

namespace App\Console\Commands\Lebify\Auth\Update\Translation;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;

class UpdateTranslationFile extends Command
{

    use CodeManipulationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:translation-js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the translation.js file with the provided code';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $TranslationJsFilePath = public_path('js/common/translation/translation.js');

        $code = <<<'JS'
export const translations = {
    // ENGLISH
    en: {
        toasts: {
            toastTitle: {
                success: "Success",
            },
            toastMessage: {
                loginSuccessfulMessage: "Welcome! You have successfully logged in.",
            },
        },

        loadingText: {
            loading: "Loading...",
            cancel: "Canceling...",
            submit: "Submitting...",
            reset: "Resetting...",
            delete: "Deleting...",
            save: "Saving...",
            add: "Adding...",
            update: "Updating...",
            search: "Searching...",
            upload: "Uploading...",
            download: "Downloading...",
            next: "Next...",
            previous: "Previous...",
            proccessing: "Processing...",
            sendRequest: "Sending request...",
            register: "Registering...",
            login: "Logging in...",
            logout: "Logging out...",
            sendEmail: "Sending email...",
            sendLink: "Sending link...",
            verifyAccount: "Verifying account...",
            wait: "Please wait...",
            verify: "Verifying...",
            resend: "Resending...",
            changeEmail: "Changing email...",
            changeUsername: "Changing username...",
            changeName: "Changing name...",
            changePhone: "Changing phone...",
            changeAddress: "Changing address...",
            changeAvatar: "Changing avatar...",
            changeCover: "Changing cover...",
            follow: "Following...",
            unfollow: "Unfollowing...",
            like: "Liking...",
            unlike: "Unliking...",
            bookmark: "Bookmarking...",
            unbookmark: "Unbookmarking...",
            report: "Reporting...",
            unreport: "Unreporting...",
            block: "Blocking...",
            unblock: "Unblocking...",
            mute: "Muting...",
            unmute: "Unmuting...",
            reportComment: "Reporting comment...",
            unreportComment: "Unreporting comment...",
            reportPost: "Reporting post...",
            unreportPost: "Unreporting post...",
            reportUser: "Reporting user...",
            unreportUser: "Unreporting user...",
            reportMedia: "Reporting media...",
            unreportMedia: "Unreporting media...",
            reportHashtag: "Reporting hashtag...",
        },

        sweetAlert: {
            button: {
                delete: "Delete",
                cancel: "Cancel",
            },
            confirm: {
                delete: {
                    title: "Are you sure?",
                    text: "Are you sure you want to delete this item? This action cannot be undone and you might lose important data.",
                }
            },
            success: {
                delete: {
                    title: "Item Deleted Successfully!",
                    text: "The item has been permanently removed. This action is irreversible and cannot be undone.",
                }
            },
            error: {
                default: {
                    title: "Oops! Something went wrong.",
                    text: "An error occurred while processing your request. Please try again later. If the issue persists, please contact support.",
                }
            }
        }
    },

    // ARABIC
    ar: {
        toasts: {
            toastTitle: {
                success: "نجاح",
            },
            toastMessage: {
                loginSuccessfulMessage: "مرحبًا! لقد قمت بتسجيل الدخول بنجاح.",
            },
        },
        loadingText: {
            loading: "جارٍ التحميل...",
            cancel: "جارٍ الإلغاء...",
            submit: "جارٍ الإرسال...",
            reset: "جارٍ إعادة التعيين...",
            delete: "جارٍ الحذف...",
            save: "جارٍ الحفظ...",
            add: "جارٍ الإضافة...",
            update: "جارٍ التحديث...",
            search: "جارٍ البحث...",
            upload: "جارٍ التحميل...",
            download: "جارٍ التنزيل...",
            next: "التالي...",
            previous: "السابق...",
            proccessing: "جارٍ المعالجة...",
            sendRequest: "جارٍ إرسال الطلب...",
            register: "جارٍ التسجيل...",
            login: "جارٍ تسجيل الدخول...",
            logout: "جارٍ تسجيل الخروج...",
            sendEmail: "جارٍ إرسال البريد الإلكتروني...",
            sendLink: "جارٍ إرسال الرابط...",
            verifyAccount: "جارٍ التحقق من الحساب...",
            wait: "يرجى الانتظار...",
            verify: "جارٍ التحقق...",
            resend: "إعادة إرسال...",
            changeEmail: "جارٍ تغيير البريد الإلكتروني...",
            changeUsername: "جارٍ تغيير اسم المستخدم...",
            changeName: "جارٍ تغيير الاسم...",
            changePhone: "جارٍ تغيير الهاتف...",
            changeAddress: "جارٍ تغيير العنوان...",
            changeAvatar: "جارٍ تغيير الصورة الرمزية...",
            changeCover: "جارٍ تغيير الغلاف...",
            follow: "جارٍ المتابعة...",
            unfollow: "جارٍ إلغاء المتابعة...",
            like: "جارٍ الإعجاب...",
            unlike: "جارٍ إلغاء الإعجاب...",
            bookmark: "جارٍ إضافة العلامة...",
            unbookmark: "جارٍ إزالة العلامة...",
            report: "جارٍ التبليغ...",
            unreport: "جارٍ إلغاء التبليغ...",
            block: "جارٍ الحظر...",
            unblock: "جارٍ إلغاء الحظر...",
            mute: "جارٍ التصميت...",
            unmute: "جارٍ إلغاء التصميت...",
            reportComment: "جارٍ التبليغ عن التعليق...",
            unreportComment: "جارٍ إلغاء التبليغ عن التعليق...",
            reportPost: "جارٍ التبليغ عن المنشور...",
            unreportPost: "جارٍ إلغاء التبليغ عن المنشور...",
            reportUser: "جارٍ التبليغ عن المستخدم...",
            unreportUser: "جارٍ إلغاء التبليغ عن المستخدم...",
            reportMedia: "جارٍ التبليغ عن الوسائط...",
            unreportMedia: "جارٍ إلغاء التبليغ عن الوسائط...",
            reportHashtag: "جارٍ التبليغ عن الوسم...",
        },

        sweetAlert: {
            button: {
                delete: "حذف",
                cancel: "إلغاء",
            },
            confirm: {
                delete: {
                    title: "هل أنت متأكد؟",
                    text: "هل أنت متأكد أنك تريد حذف هذا العنصر؟ لا يمكن التراجع عن هذا الإجراء وقد تفقد بيانات مهمة.",
                }
            },
            success: {
                delete: {
                    title: "تم حذف العنصر بنجاح!",
                    text: "تمت إزالة العنصر نهائيًا. هذا الإجراء لا يمكن التراجع عنه",
                }
            },
            error: {
                default: {
                    title: "عذرًا! حدث خطأ ما.",
                    text: "حدث خطأ أثناء معالجة طلبك. يرجى المحاولة مرة أخرى لاحقًا. إذا استمرت المشكلة، يرجى الاتصال بالدعم.",
                }
            }
        }
    },

    // FRENCH
    fr: {
        toasts: {
            toastTitle: {
                success: "Succès",
            },
            toastMessage: {
                loginSuccessfulMessage: "Bienvenue! Vous vous êtes connecté avec succès.",
            },
        },

        loadingText: {
            loading: "Chargement...",
            cancel: "Annulation...",
            submit: "Soumission...",
            reset: "Réinitialisation...",
            delete: "Suppression...",
            save: "Enregistrement...",
            add: "Ajout...",
            update: "Mise à jour...",
            search: "Recherche...",
            upload: "Téléchargement...",
            download: "Téléchargement...",
            next: "Suivant...",
            previous: "Précédent...",
            proccessing: "Traitement...",
            sendRequest: "Envoi de la demande...",
            register: "Inscription...",
            login: "Connexion...",
            logout: "Déconnexion...",
            sendEmail: "Envoi de l'email...",
            sendLink: "Envoi du lien...",
            verifyAccount: "Vérification du compte...",
            wait: "Veuillez patienter...",
            verify: "Vérification...",
            resend: "Renvoi...",
            changeEmail: "Modification de l'email...",
            changeUsername: "Modification du nom d'utilisateur...",
            changeName: "Modification du nom...",
            changePhone: "Modification du téléphone...",
            changeAddress: "Modification de l'adresse...",
            changeAvatar: "Modification de l'avatar...",
            changeCover: "Modification de la couverture...",
            follow: "Suivi...",
            unfollow: "Arrêter de suivre...",
            like: "J'aime...",
            unlike: "Je n'aime pas...",
            bookmark: "Mise en favori...",
            unbookmark: "Supprimer le favori...",
            report: "Signalement...",
            unreport: "Annuler le signalement...",
            block: "Blocage...",
            unblock: "Déblocage...",
            mute: "Muet...",
            unmute: "Activer le son...",
            reportComment: "Signalement du commentaire...",
            unreportComment: "Annuler le signalement du commentaire...",
            reportPost: "Signalement du post...",
            unreportPost: "Annuler le signalement du post...",
            reportUser: "Signalement de l'utilisateur...",
            unreportUser: "Annuler le signalement de l'utilisateur...",
            reportMedia: "Signalement du média...",
            unreportMedia: "Annuler le signalement du média...",
            reportHashtag: "Signalement du hashtag...",
        },

        sweetAlert: {
            button: {
                delete: "Supprimer",
                cancel: "Annuler",
            },
            confirm: {
                delete: {
                    title: "Êtes-vous sr?",
                    text: "Êtes-vous sr de vouloir supprimer cet élément? Cette action ne peut pas être annulée et vous pourriez perdre des données importantes.",
                }
            },
            success: {
                delete: {
                    title: "Élément supprimé avec succès!",
                    text: "L'élément a été supprimé. Cette action est irréversible et ne peut pas être annulée.",
                }
            },
            error: {
                default: {
                    title: "Oups ! Quelque chose s'est mal passé.",
                    text: "Une erreur s'est produite lors du traitement de votre demande. Veuillez réessayer plus tard. Si le problème persiste, veuillez contacter le support.",
                }
            }
        }
    },

    // SPANISH
    es: {
        toasts: {
            toastTitle: {
                success: "Éxito",
            },
            toastMessage: {
                loginSuccessfulMessage: "¡Bienvenido de nuevo! Has iniciado sesión correctamente.",
            },
        },

        loadingText: {
            loading: "Cargando...",
            cancel: "Cancelando...",
            submit: "Enviando...",
            reset: "Restableciendo...",
            delete: "Borrando...",
            save: "Guardando...",
            add: "Añadiendo...",
            update: "Actualizando...",
            search: "Buscando...",
            upload: "Subiendo...",
            download: "Descargando...",
            next: "Siguiente...",
            previous: "Anterior...",
            proccessing: "Procesando...",
            sendRequest: "Enviando solicitud...",
            register: "Registrando...",
            login: "Iniciando sesión...",
            logout: "Cerrando sesión...",
            sendEmail: "Enviando correo electrónico...",
            sendLink: "Enviando enlace...",
            verifyAccount: "Verificando cuenta...",
            wait: "Por favor, espera...",
            verify: "Verificando...",
            resend: "Reenviando...",
            changeEmail: "Cambiando correo electrónico...",
            changeUsername: "Cambiando nombre de usuario...",
            changeName: "Cambiando nombre...",
            changePhone: "Cambiando teléfono...",
            changeAddress: "Cambiando dirección...",
            changeAvatar: "Cambiando avatar...",
            changeCover: "Cambiando portada...",
            follow: "Siguiendo...",
            unfollow: "Dejando de seguir...",
            like: "Me gusta...",
            unlike: "No me gusta...",
            bookmark: "Marcando como favorito...",
            unbookmark: "Desmarcando como favorito...",
            report: "Reportando...",
            unreport: "Cancelando reporte...",
            block: "Bloqueando...",
            unblock: "Desbloqueando...",
            mute: "Silenciando...",
            unmute: "Quitando silencio...",
            reportComment: "Reportando comentario...",
            unreportComment: "Cancelando reporte de comentario...",
            reportPost: "Reportando publicación...",
            unreportPost: "Cancelando reporte de publicación...",
            reportUser: "Reportando usuario...",
            unreportUser: "Cancelando reporte de usuario...",
            reportMedia: "Reportando multimedia...",
            unreportMedia: "Cancelando reporte de multimedia...",
            reportHashtag: "Reportando hashtag...",
        },

        sweetAlert: {
            button: {
                delete: "Eliminar",
                cancel: "Cancelar",
            },
            confirm: {
                delete: {
                    title: "¿Estás seguro?",
                    text: "¿Estás seguro de que deseas eliminar este elemento? Esta acción no se puede deshacer y podrías perder datos importantes.",
                }
            },
            success: {
                delete: {
                    title: "Elemento eliminado con éxito!",
                    text: "El elemento ha sido eliminado. Esta acción no se puede deshacer.",
                }
            },
            error: {
                default: {
                    title: "Oops! Algo salió mal.",
                    text: "Se produjo un error al procesar tu solicitud. Por favor, inténtalo de nuevo más tarde. Si el problema persiste, por favor, contáctanos.",
                }
            }
        }
    },

    // GERMAN
    de: {
        toasts: {
            toastTitle: {
                success: "Erfolg",
            },
            toastMessage: {
                loginSuccessfulMessage: "Willkommen zurück! Sie haben sich erfolgreich angemeldet.",
            },
        },
        loadingText: {
            loading: "Laden...",
            cancel: "Abbrechen...",
            submit: "Senden...",
            reset: "Zurücksetzen...",
            delete: "Löschen...",
            save: "Speichern...",
            add: "Hinzufügen...",
            update: "Aktualisieren...",
            search: "Suchen...",
            upload: "Hochladen...",
            download: "Herunterladen...",
            next: "Weiter...",
            previous: "Zurück...",
            proccessing: "Verarbeiten...",
            sendRequest: "Anfrage senden...",
            register: "Registrieren...",
            login: "Anmelden...",
            logout: "Abmelden...",
            sendEmail: "E-Mail senden...",
            sendLink: "Link senden...",
            verifyAccount: "Konto verifizieren...",
            wait: "Bitte warten...",
            verify: "Verifizieren...",
            resend: "Erneut senden...",
            changeEmail: "E-Mail ändern...",
            changeUsername: "Benutzernamen ändern...",
            changeName: "Namen ändern...",
            changePhone: "Telefonnummer ändern...",
            changeAddress: "Adresse ändern...",
            changeAvatar: "Avatar ändern...",
            changeCover: "Titelbild ändern...",
            follow: "Folgen...",
            unfollow: "Nicht mehr folgen...",
            like: "Gefällt mir...",
            unlike: "Gefällt mir nicht mehr...",
            bookmark: "Lesezeichen setzen...",
            unbookmark: "Lesezeichen entfernen...",
            report: "Melden...",
            unreport: "Meldung zurückziehen...",
            block: "Blockieren...",
            unblock: "Entsperren...",
            mute: "Stummschalten...",
            unmute: "Stummschaltung aufheben...",
            reportComment: "Kommentar melden...",
            unreportComment: "Meldung des Kommentars zurückziehen...",
            reportPost: "Beitrag melden...",
            unreportPost: "Meldung des Beitrags zurückziehen...",
            reportUser: "Benutzer melden...",
            unreportUser: "Meldung des Benutzers zurückziehen...",
            reportMedia: "Medien melden...",
            unreportMedia: "Meldung der Medien zurückziehen...",
            reportHashtag: "Hashtag melden...",
        },

        sweetAlert: {
            button: {
                delete: "Verwijderen",
                cancel: "Annuleren",
            },
            confirm: {
                delete: {
                    title: "Weet je het zeker?",
                    text: "Weet je zeker dat je dit item wilt verwijderen? Deze actie kan niet ongedaan worden gemaakt en je kunt belangrijke gegevens verliezen.",
                }
            },
            success: {
                delete: {
                    title: "Item verwijderd met succes!",
                    text: "Het item is verwijderd. Deze actie kan niet ongedaan worden gemaakt.",
                }
            },
            error: {
                default: {
                    title: "Oops! Iets is fout.",
                    text: "Er is iets fout gegaan tijdens het verwerken van uw aanvraag. Probeer het opnieuw. Als het probleem blijft bestaan, neem dan contact op met de ondersteuning.",
                }
            }
        }
    },

    // JAPANESE
    ja: {
        toasts: {
            toastTitle: {
                success: "成功",
            },
            toastMessage: {
                loginSuccessfulMessage: "お帰りなさい！ログインに成功しました。",
            },
        },

        loadingText: {
            loading: "読み込み中...",
            cancel: "キャンセル中...",
            submit: "送信中...",
            reset: "リセット中...",
            delete: "削除中...",
            save: "保存中...",
            add: "追加中...",
            update: "更新中...",
            search: "検索中...",
            upload: "アップロード中...",
            download: "ダウンロード中...",
            next: "次へ...",
            previous: "前へ...",
            proccessing: "処理中...",
            sendRequest: "リクエスト送信中...",
            register: "登録中...",
            login: "ログイン中...",
            logout: "ログアウト中...",
            sendEmail: "メール送信中...",
            sendLink: "リンク送信中...",
            verifyAccount: "アカウント検証中...",
            wait: "お待ちください...",
            verify: "検証中...",
            resend: "再送中...",
            changeEmail: "メールアドレス変更中...",
            changeUsername: "ユーザー名変更中...",
            changeName: "名前変更中...",
            changePhone: "電話番号変更中...",
            changeAddress: "住所変更中...",
            changeAvatar: "アバター変更中...",
            changeCover: "カバー変更中...",
            follow: "フォロー中...",
            unfollow: "フォロー解除中...",
            like: "いいね中...",
            unlike: "いいね解除中...",
            bookmark: "ブックマーク中...",
            unbookmark: "ブックマーク解除中...",
            report: "通報中...",
            unreport: "通報取り消し中...",
            block: "ブロック中...",
            unblock: "ブロック解除中...",
            mute: "ミュート中...",
            unmute: "ミュート解除中...",
            reportComment: "コメント通報中...",
            unreportComment: "コメント通報取り消し中...",
            reportPost: "投稿通報中...",
            unreportPost: "投稿通報取り消し中...",
            reportUser: "ユーザー通報中...",
            unreportUser: "ユーザー通報取り消し中...",
            reportMedia: "メディア通報中...",
            unreportMedia: "メディア通報取り消し中...",
            reportHashtag: "ハッシュタグ通報中...",
        },

        sweetAlert: {
            button: {
                delete: "削除",
                cancel: "キャンセル",
            },
            confirm: {
                delete: {
                    title: "本当に削除しますか？",
                    text: "本当に削除しますか？この操作は元に戻せません。重要なデータを失います。",
                }
            },
            success: {
                delete: {
                    title: "削除されました！",
                    text: "削除されました。この操作は元に戻せません。",
                }
            },
            error: {
                default: {
                    title: "Oops! Algo salió mal.",
                    text: "Se produjo un error al procesar tu solicitud. Por favor, inténtalo de nuevo más tarde. Si el problema persiste, por favor, contáctanos.",
                }
            }
        }
    },

}

export class Translator {
    constructor() {
        this.currentLocale = document.documentElement.lang;
    }

    getTranslation(key) {
        const keys = key.split(".");
        let translation = translations[this.currentLocale];

        for (const k of keys) {
            translation = translation[k];
        }

        return translation;
    }

    getToastTitle(toastTitleKey) {
        return this.getTranslation(`toasts.toastTitle.${toastTitleKey}`);
    }

    getToastMessage(toastMessageKey) {
        return this.getTranslation(`toasts.toastMessage.${toastMessageKey}`);
    }

    getloadingText(loadingKey) {
        return this.getTranslation(`loadingText.${loadingKey}`);
    }

    getSweetAlert(sweetAlertKey) {
        return this.getTranslation(`sweetAlert.${sweetAlertKey}`);
    }

    getSweetAlertConfirm(sweetAlertConfirmKey) {
        return this.getTranslation(`sweetAlert.confirm.${sweetAlertConfirmKey}`);
    }

    getSweetAlertButton(sweetAlertButtonKey) {
        return this.getTranslation(`sweetAlert.button.${sweetAlertButtonKey}`);
    }

    getSweetAlertSuccess(sweetAlertSuccessKey) {
        return this.getTranslation(`sweetAlert.success.${sweetAlertSuccessKey}`);
    }

    getSweetAlertError(sweetAlertErrorKey) {
        return this.getTranslation(`sweetAlert.error.${sweetAlertErrorKey}`);
    }
}
JS;

        $this->addCodeToFile($TranslationJsFilePath, $code);
        $this->info('The translation.js file has been updated successfully.');
    }
}
