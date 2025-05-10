<?php

/**
 * @property CI_Loader $load
 * @property CI_Config $config
 * @property CI_Input $input
 * @property CI_URI $uri
 * @property CI_Router $router
 * @property CI_Output $output
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_DB_query_builder $db
 * @property CI_Security $security
 * @property CI_Email $email
 * @property CI_User_agent $agent
 * @property Customlib $customlib
 * @property Notification_model $notification_model
 * @property Transaction_model $transaction_model
 * @property CI_Lang $lang
 * @property Setting_model $setting_model
 * @property Admin_model Admin_model
 * @property Ambulance_model Ambulance_model
 * @property Antenatal_model Antenatal_model
 * @property Appoint_priority_model Appoint_priority_model
 * @property Appointment_model Appointment_model
 * @property Attendencetype_model Attendencetype_model
 * @property Audit_model Audit_model
 * @property Avha_create Avha_create
 * @property Bed_model Bed_model
 * @property Bedgroup_model Bedgroup_model
 * @property Bedtype_model Bedtype_model
 * @property Bill_model Bill_model
 * @property Birthordeath_model Birthordeath_model
 * @property Blood_donorcycle_model Blood_donorcycle_model
 * @property Bloodbankstatus_model Bloodbankstatus_model
 * @property Blooddonor_model Blooddonor_model
 * @property Bloodissue_model Bloodissue_model
 * @property Bulkmessage_model Bulkmessage_model
 * @property Calendar_model Calendar_model
 * @property Captcha_model Captcha_model
 * @property Casereference_model Casereference_model
 * @property Certificate_model Certificate_model
 * @property Charge_category_model Charge_category_model
 * @property Charge_model Charge_model
 * @property Chargetype_model Chargetype_model
 * @property Chatuser_model Chatuser_model
 * @property Cms_media_model Cms_media_model
 * @property Cms_menu_model Cms_menu_model
 * @property Cms_menuitems_model Cms_menuitems_model
 * @property Cms_page_content_model Cms_page_content_model
 * @property Cms_page_model Cms_page_model
 * @property Cms_program_model Cms_program_model
 * @property ComplaintType_model ComplaintType_model
 * @property Complaint_model Complaint_model
 * @property Conference_model Conference_model
 * @property Conferencehistory_model Conferencehistory_model
 * @property Consultcharge_model Consultcharge_model
 * @property Content_model Content_model
 * @property Contenttype_model Contenttype_model
 * @property Customfield_model Customfield_model
 * @property Department_model Department_model
 * @property Designation_model Designation_model
 * @property Dispatch_model Dispatch_model
 * @property Dutyroster_model Dutyroster_model
 * @property Emailconfig_model Emailconfig_model
 * @property Expense_model Expense_model
 * @property Expensehead_model Expensehead_model
 * @property Expmedicine_model Expmedicine_model
 * @property Filetype_model Filetype_model
 * @property Finding_model Finding_model
 * @property Floor_model Floor_model
 * @property Frontcms_setting_model Frontcms_setting_model
 * @property Gateway_ins_model Gateway_ins_model
 * @property General_call_model General_call_model
 * @property Generatecertificate_model Generatecertificate_model
 * @property Generatepatientidcard_model Generatepatientidcard_model
 * @property Generatestaffidcard_model Generatestaffidcard_model
 * @property Holiday_model Holiday_model
 * @property Income_model Income_model
 * @property Incomehead_model Incomehead_model
 * @property Item_model Item_model
 * @property Itemcategory_model Itemcategory_model
 * @property Itemissue_model Itemissue_model
 * @property Itemstock_model Itemstock_model
 * @property Itemstore_model Itemstore_model
 * @property Itemsupplier_model Itemsupplier_model
 * @property Lab_model Lab_model
 * @property Language_model Language_model
 * @property Leaverequest_model Leaverequest_model
 * @property Leavetypes_model Leavetypes_model
 * @property Medicine_category_model Medicine_category_model
 * @property Medicine_dosage_model Medicine_dosage_model
 * @property Messages_model Messages_model
 * @property Module_model Module_model
 * @property Modulepermission_model Modulepermission_model
 * @property Notification_model Notification_model
 * @property Notificationsetting_model Notificationsetting_model
 * @property Onlineappointment_model Onlineappointment_model
 * @property Operationtheatre_model Operationtheatre_model
 * @property Organisation_model Organisation_model
 * @property Pathology_category_model Pathology_category_model
 * @property Pathology_model Pathology_model
 * @property Patient_id_card_model Patient_id_card_model
 * @property Patient_model Patient_model
 * @property Payment_model Payment_model
 * @property Paymentsetting_model Paymentsetting_model
 * @property Payroll_model Payroll_model
 * @property Pharmacy_model Pharmacy_model
 * @property Prefix_model Prefix_model
 * @property Prescription_model Prescription_model
 * @property Printing_model Printing_model
 * @property Radio_model Radio_model
 * @property Referral_category_model Referral_category_model
 * @property Referral_commission_model Referral_commission_model
 * @property Referral_payment_model Referral_payment_model
 * @property Referral_person_model Referral_person_model
 * @property Report_model Report_model
 * @property Role_model Role_model
 * @property Rolepermission_model Rolepermission_model
 * @property Setting_model Setting_model
 * @property Sharecontent_model Sharecontent_model
 * @property Smsconfig_model Smsconfig_model
 * @property Source_model Source_model
 * @property Specialist_model Specialist_model
 * @property StaffAttendaceSetting_model StaffAttendaceSetting_model
 * @property Staff_model Staff_model
 * @property Staffattendancemodel Staffattendancemodel
 * @property Staffidcard_model Staffidcard_model
 * @property Staffroles_model Staffroles_model
 * @property Symptoms_model Symptoms_model
 * @property Systemnotification_model Systemnotification_model
 * @property Taxcategory_model Taxcategory_model
 * @property Timeline_model Timeline_model
 * @property Tpa_model Tpa_model
 * @property Transaction_model Transaction_model
 * @property Unittype_model Unittype_model
 * @property Uploadcontent_model Uploadcontent_model
 * @property User_model User_model
 * @property Userlog_model Userlog_model
 * @property Userpermission_model Userpermission_model
 * @property Vehicle_model Vehicle_model
 * @property Visitors_model Visitors_model
 * @property Visitors_purpose_model Visitors_purpose_model
 * @property Vital_model Vital_model
 * @property Paymentsetting_model $paymentsetting_model // Provides access to the Paymentsetting_model
 * @property Setting_model $setting_model // Provides access to the Setting_model
 * @property Module_lib $module_lib // Provides access to the Module_lib
 * @property Notificationsetting_model $notificationsetting_model // Provides access to the Notificationsetting_model
 * @property Userlog_model $userlog_model // Provides access to the Userlog_model
 * @property Staff_model $staff_model // Provides access to the Staff_model
 * @property Calendar_model $calendar_model // Provides access to the Calendar_model
 * @property Language_model $language_model // Provides access to the Language_model
 * @property Appointment_model $appointment_model // Provides access to the Appointment_model
 * @property Onlineappointment_model $onlineappointment_model // Provides access to the Onlineappointment_model
 * @property Zend $zend // Provides access to the Zend library
 * @property QR_Code $qr_code // Provides access to the QR_Code library
 * @property CI_Config $config // Provides access to CodeIgniter's config class
 * @property CI_Form_validation $form_validation // Provides access to CodeIgniter's form validation library
 * @property CI_Session $session // Provides access to CodeIgniter's session class
 * @property Rbac $rbac // Provides access to the RBAC (Role-Based Access Control) library
 * @property Staff_model $staff_model // Provides access to the Staff_model
 * @property Charge_model $charge_model // Provides access to the Charge_model
 * @property Organisation_model $organisation_model // Provides access to the Organisation_model
 * @property Tpa_model $tpa_model // Provides access to the Tpa_model
 * @property Customlib $customlib // Provides access to the Customlib library
 * @property CI_Input $input // Provides access to CodeIgniter's input class
 * @property CI_Lang $lang // Provides access to CodeIgniter's language class
 * @property Chatuser_model $chatuser_model This model handles chat user-related operations, including fetching unread chat counts.
 */
class CI_Controller
{
}