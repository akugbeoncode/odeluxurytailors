import Vue from "vue";
import VueRouter from "vue-router";

import ManagersComponent from "../views/managers/ApplicationRoot.vue";
import LaundryComponent from "../views/laundry/ApplicationRoot.vue";
import TailorsComponent from "../views/tailors/ApplicationRoot.vue";
import ServiceComponent from "../views/services/ApplicationRoot.vue";

import ManagementLogin from '../views/Login.vue';

import ManagerUserAccountDashboard from "../views/managers/ManagerUserAccountDashboard.vue";
import ApplicationEmailRoot from "../views/common/ApplicationEmailRoot.vue";
import ApplicationChatRoot from "../views/common/ApplicationChatRoot.vue";
import ApplicationProfileRoot from "../views/common/ApplicationProfileRoot.vue";
import ApplicationSettingsRoot from "../views/common/ApplicationSettingsRoot.vue";
import TailorUserAccountDashboard from "../views/tailors/TailorUserAccountDashboard.vue";
import ServiceUserAccountDashboard from "../views/services/ServiceUserAccountDashboard.vue";
import LaundryUserAccountDashboard from "../views/laundry/LaundryUserAccountDashboard.vue";

// Manager Routes Components

import  EmployeeManagerViewAllEmployees from "../views/managers/employees/all.vue"
import  EmployeeManagerCreateEmployeeAccount from "../views/managers/employees/create.vue"
import  EmployeeManagerEmployeeAccountDetails from "../views/managers/employees/details.vue"
import  EmployeeManagerEditEmployeeAccount from "../views/managers/employees/edit.vue"

import TransactionManagerFashionBusinessAllTransactions from "../views/managers/transactions/TransactionManagerFashionBusinessAllTransactions.vue"
import TransactionManagerRegisterNewFashionTransaction from "../views/managers/transactions/TransactionManagerRegisterNewFashionTransaction.vue"
import TransactionManagerFashionBusinessTransactionRecordDetails from "../views/managers/transactions/TransactionManagerFashionBusinessTransactionRecordDetails.vue"
import TransactionManagerFashionBusinessEditTransactionRecord from "../views/managers/transactions/TransactionManagerFashionBusinessEditTransactionRecord.vue"
import TransactionManagerLaundryBusinessAllTransactions from "../views/managers/transactions/TransactionManagerLaundryBusinessAllTransactions.vue"
import TransactionManagerRegisterNewLaundryTransaction from "../views/managers/transactions/TransactionManagerRegisterNewLaundryTransaction.vue"
import TransactionManagerLaundryBusinessTransactionRecordDetails from "../views/managers/transactions/TransactionManagerLaundryBusinessTransactionRecordDetails.vue"
import TransactionManagerLaundryBusinessEditTransactionRecord from "../views/managers/transactions/TransactionManagerLaundryBusinessEditTransactionRecord.vue"

import TaskManagerAllTasks from "../views/managers/tasks/TaskManagerAllTasks.vue"
import TaskManagerTaskDetails from "../views/managers/tasks/TaskManagerTaskDetails.vue"

import InventoryManangerAllItems  from "../views/managers/inventory/InventoryManangerAllItems.vue"
import InventoryManangerAddInventoryItem  from "../views/managers/inventory/InventoryManangerAddInventoryItem.vue"
import InventoryManangerInventoryItemDetails  from "../views/managers/inventory/InventoryManangerInventoryItemDetails.vue"
import InventoryManangerEditInventoryItemDetails  from "../views/managers/inventory/InventoryManangerEditInventoryItemDetails.vue"

import PayrollManagerEmployeePayslip  from "../views/managers/payroll/PayrollManagerEmployeePayslip.vue"
import PayrollManagerEmployeeSalaries  from "../views/managers/payroll/PayrollManagerEmployeeSalaries.vue"
import PayrollManagerAddEmployeeSalary  from "../views/managers/payroll/PayrollManagerAddEmployeeSalary.vue"
import PayrollManagerEditEmployeeSalary  from "../views/managers/payroll/PayrollManagerEditEmployeeSalary.vue"

import AccountManagerAddExpense  from "../views/managers/accounts/AccountManagerAddExpense.vue"
import AccountManagerEditExpenseDetails  from "../views/managers/accounts/AccountManagerEditExpenseDetails.vue"
import AccountManagerExpenseDetails  from "../views/managers/accounts/AccountManagerExpenseDetails.vue"
import AccountManagerExpenses  from "../views/managers/accounts/AccountManagerExpenses.vue"
import AccountManagerAddInvoice  from "../views/managers/accounts/AccountManagerAddInvoice.vue"
import AccountManagerEditInvoiceDetails  from "../views/managers/accounts/AccountManagerEditInvoiceDetails.vue"
import AccountManagerInvoiceDetails  from "../views/managers/accounts/AccountManagerInvoiceDetails.vue"
import AccountManagerInvoices  from "../views/managers/accounts/AccountManagerInvoices.vue"

import ReportManagerGenerateReportOptionPage from '../views/managers/reports/ReportManagerGenerateReportOptionPage.vue';

import AddCategory from '../views/managers/resources/categories/add.vue';
import AllCategories from '../views/managers/resources/categories/all.vue';
import CategoryDetails from '../views/managers/resources/categories/details.vue';
import EditCategory from '../views/managers/resources/categories/edit.vue';

import AllBrands from '../views/managers/resources/brands/all.vue';
import AddBrand from '../views/managers/resources/brands/add.vue';
import BrandDetails from '../views/managers/resources/brands/details.vue';
import EditBrand from '../views/managers/resources/brands/edit.vue';

import ProductUnits from '../views/managers/resources/units/all.vue';
import AddProductUnit from '../views/managers/resources/units/add.vue';
import ProductUnitDetails from '../views/managers/resources/units/details.vue';
import EditProductUnit from '../views/managers/resources/units/edit.vue';

import AllProducts from '../views/managers/products/all.vue';
import AddProduct from '../views/managers/products/add.vue';
import ProductDetails from '../views/managers/products/details.vue';
import EditProductDetails from '../views/managers/products/edit.vue';

import AllProductVariants from '../views/managers/product_variant/all.vue';
import AddProductVariant from '../views/managers/product_variant/add.vue';
import ProductVariantDetails from '../views/managers/product_variant/details.vue';
import EditProductVariantDetails from '../views/managers/product_variant/edit.vue';

import AllSettings from '../views/managers/resources/settings/add.vue';
import AddSetting from '../views/managers/resources/settings/add.vue';
import SettingDetails from '../views/managers/resources/settings/add.vue';
import EditSetting from '../views/managers/resources/settings/add.vue';

// Email Routes Components
import OLTsEmailInboxEmails from "../views/common/emails/OLTsEmailInboxEmails.vue"
import OLTsEmailComposeEmail from "../views/common/emails/OLTsEmailComposeEmail.vue"
import OLTsEmailDraftEmails from "../views/common/emails/OLTsEmailDraftEmails.vue"
import OLTsEmailSentEmails from "../views/common/emails/OLTsEmailSentEmails.vue"
import OLTsEmailStarredEmails from "../views/common/emails/OLTsEmailStarredEmails.vue"
import OLTsEmailTrashEmails from "../views/common/emails/OLTsEmailTrashEmails.vue"
import OLTsEmailTemplateAllTemplates from "../views/common/emails/OLTsEmailTemplateAllTemplates.vue"
import OLTsEmailTemplateCreateTemplate from "../views/common/emails/OLTsEmailTemplateCreateTemplate.vue"
import OLTsEmailTemplateEditTemplate from "../views/common/emails/OLTsEmailTemplateEditTemplate.vue"
import OLTsEmailTemplateTemplateDetails from "../views/common/emails/OLTsEmailTemplateTemplateDetails.vue"
import OLTsSMSTemplateAllTemplates from "../views/common/emails/OLTsSMSTemplateAllTemplates.vue"
import OLTsSMSTemplateCreateTemplate from "../views/common/emails/OLTsSMSTemplateCreateTemplate.vue"
import OLTsSMSTemplateTemplateDetails from "../views/common/emails/OLTsSMSTemplateTemplateDetails.vue"
import OLTsSMSTemplateEditTemplate from "../views/common/emails/OLTsSMSTemplateEditTemplate.vue"

// Chat Routes Components
import  ChatManagerApplication from "../views/common/ChatManagerApplication.vue"

// Services and Laundry Components

import ServiceUserRegisterNewTransaction from "../views/services/transactions/ServiceUserRegisterNewTransaction.vue"
import ServiceUserRegisteredTransactions from "../views/services/transactions/ServiceUserRegisteredTransactions.vue"

import LaundryUserRegisterNewTransaction from "../views/laundry/transactions/LaundryUserRegisterNewTransaction.vue"
import LaundryUserRegisteredTransactions from "../views/laundry/transactions/LaundryUserRegisteredTransactions.vue"

// Logged User Profile Components
import LoggedUserProfileDetails from "../views/common/profile/details.vue"
import EditLoggedUserProfileDetails from "../views/common/profile/edit.vue"
import LoggedUserChangeProfilePassword from "../views/common/profile/changePassword.vue"
import LoggedUserChangeProfileImage from "../views/common/profile/changePhoto.vue"

// Settings Components
import GeneralSettings from "../views/common/settings/generalSettings.vue"

const managersRoutes = [
  { path: "", name: "ManagerUserAccountDashboard", component: ManagerUserAccountDashboard },

  { path: "employees", name: "EmployeeManagerViewAllEmployees", component: EmployeeManagerViewAllEmployees },
  { path: "employees/create-employee-account", name: "EmployeeManagerCreateEmployeeAccount", component: EmployeeManagerCreateEmployeeAccount },
  { path: "employees/:employeeID", name: "EmployeeManagerEmployeeAccountDetails", component: EmployeeManagerEmployeeAccountDetails },
  { path: "employees/:employeeID/edit-employee-account", name: "EmployeeManagerEditEmployeeAccount", component: EmployeeManagerEditEmployeeAccount },

  { path: "fashion-business/transactions", name: "TransactionManagerFashionBusinessAllTransactions", component: TransactionManagerFashionBusinessAllTransactions },
  { path: "fashion-business/transactions/new-transaction", name: "TransactionManagerRegisterNewFashionTransaction", component: TransactionManagerRegisterNewFashionTransaction },
  { path: "fashion-business/transactions/:transactionID", name: "TransactionManagerFashionBusinessTransactionRecordDetails", component: TransactionManagerFashionBusinessTransactionRecordDetails },
  { path: "fashion-business/transactions/:transactionID/edit-transaction-record", name: "TransactionManagerFashionBusinessEditTransactionRecord", component: TransactionManagerFashionBusinessEditTransactionRecord },

  { path: "laundry-business/transactions", name: "TransactionManagerLaundryBusinessAllTransactions", component: TransactionManagerLaundryBusinessAllTransactions },
  { path: "laundry-business/transactions/new-transaction", name: "TransactionManagerRegisterNewLaundryTransaction", component: TransactionManagerRegisterNewLaundryTransaction },
  { path: "laundry-business/transactions/:transactionID", name: "TransactionManagerLaundryBusinessTransactionRecordDetails", component: TransactionManagerLaundryBusinessTransactionRecordDetails },
  { path: "laundry-business/transactions/:transactionID/edit-transaction-record", name: "TransactionManagerLaundryBusinessEditTransactionRecord", component: TransactionManagerLaundryBusinessEditTransactionRecord },

  { path: "tasks", name: "TaskManagerAllTasks", component: TaskManagerAllTasks },
  { path: "tasks/:taskID", name: "TaskManagerTaskDetails", component: TaskManagerTaskDetails },

  { path: "inventories", name: "InventoryManangerAllItems", component: InventoryManangerAllItems },
  { path: "inventories/add-inventory-item", name: "InventoryManangerAddInventoryItem", component: InventoryManangerAddInventoryItem },
  { path: "inventories/:itemID", name: "InventoryManangerInventoryItemDetails", component: InventoryManangerInventoryItemDetails },
  { path: "inventories/:itemID/edit-inventory-item-details", name: "InventoryManangerEditInventoryItemDetails", component: InventoryManangerEditInventoryItemDetails },

  { path: "employee-salaries", name: "PayrollManagerEmployeeSalaries", component: PayrollManagerEmployeeSalaries },
  { path: "employee-salaries/add-employee-salary", name: "PayrollManagerAddEmployeeSalary", component: PayrollManagerAddEmployeeSalary },
  { path: "employee-salaries/:employeeSalaryID", name: "PayrollManagerEmployeePayslip", component: PayrollManagerEmployeePayslip },
  { path: "employee-salaries/:employeeSalaryID/edit-employee-salary", name: "PayrollManagerEditEmployeeSalary", component: PayrollManagerEditEmployeeSalary },
  
  { path: "expenses", name: "AccountManagerExpenses", component: AccountManagerExpenses },
  { path: "expenses/add-expense", name: "AccountManagerAddExpense", component: AccountManagerAddExpense },
  { path: "expenses/:expenseID", name: "AccountManagerExpenseDetails", component: AccountManagerExpenseDetails },
  { path: "expenses/:expenseID/edit-expense", name: "AccountManagerEditExpenseDetails", component: AccountManagerEditExpenseDetails },

  { path: "invoices", name: "AccountManagerInvoices", component: AccountManagerInvoices },
  { path: "invoices/add-invoice", name: "AccountManagerAddInvoice", component: AccountManagerAddInvoice },
  { path: "invoices/:invoiceID", name: "AccountManagerInvoiceDetails", component: AccountManagerInvoiceDetails },
  { path: "invoices/:invoiceID/edit-invoice", name: "AccountManagerEditInvoiceDetails", component: AccountManagerEditInvoiceDetails },

  { path: "reports-options", name: "ReportManagerGenerateReportOptionPage", component: ReportManagerGenerateReportOptionPage },

  { path: "brands", name: "AllBrands", component: AllBrands },
  { path: "brands/add-brand", name: "AddBrand", component: AddBrand },
  { path: "brands/:brandID", name: "BrandDetails", component: BrandDetails },
  { path: "brands/:brandID/edit-brand", name: "EditBrand", component: EditBrand },

  { path: "categories", name: "AllCategories", component: AllCategories },
  { path: "categories/add-category", name: "AddCategory", component: AddCategory },
  { path: "categories/:categoryID", name: "CategoryDetails", component: CategoryDetails },
  { path: "categories/:categoryID/edit-category", name: "EditCategory", component: EditCategory },

  { path: "product-units", name: "ProductUnits", component: ProductUnits }, 
  { path: "product-units/add-unit", name: "AddProductUnit", component: AddProductUnit },
  { path: "product-units/:unitID", name: "ProductUnitDetails", component: ProductUnitDetails },
  { path: "product-units/:unitID/edit-unit", name: "EditProductUnit", component: EditProductUnit },

  { path: "products", name: "AllProducts", component: AllProducts },
  { path: "products/add-products", name: "AddProduct", component: AddProduct },
  { path: "products/:productID", name: "ProductDetails", component: ProductDetails },
  { path: "products/:productID/edit-product-details", name: "EditProductDetails", component: EditProductDetails },

  { path: "/product-variants", name: "AllProductVariants", component: AllProducts },
  { path: "/product-variants/add-product-variant", name: "AddProductVariant", component: AddProductVariant },
  { path: "/product-variants/:productVariantID", name: "ProductVariantDetails", component: ProductVariantDetails },
  { path: "/product-variants/:productVariantID/edit-product-variant-details", name: "EditProductVariantDetails", component: EditProductVariantDetails },

  { path: "settings", name: "AllSettings", component: AllSettings },
  { path: "settings/add-setting", name: "AddSetting", component: AddSetting },
  { path: "settings/:settingID", name: "SettingDetails", component: SettingDetails },
  { path: "settings/:settingID/edit-setting", name: "EditSetting", component: EditSetting },
]

const emailsRoutes = [
  { path: "inbox", name: "OLTsEmailInboxEmails", component: OLTsEmailInboxEmails },
  { path: "compose-email", name: "OLTsEmailComposeEmail", component: OLTsEmailComposeEmail },
  { path: "starred-emails", name: "OLTsEmailStarredEmails", component: OLTsEmailStarredEmails },
  { path: "sent-emails", name: "OLTsEmailSentEmails", component: OLTsEmailSentEmails },
  { path: "drafted-emails", name: "OLTsEmailDraftEmails", component: OLTsEmailDraftEmails },
  { path: "trashed-emails", name: "OLTsEmailTrashEmails", component: OLTsEmailTrashEmails },
  { path: "email-templates", name: "OLTsEmailTemplateAllTemplates", component: OLTsEmailTemplateAllTemplates },
  { path: "email-templates/create-template", name: "OLTsEmailTemplateCreateTemplate", component: OLTsEmailTemplateCreateTemplate },
  { path: "email-templates/:emailTemplateID", name: "OLTsEmailTemplateTemplateDetails", component: OLTsEmailTemplateTemplateDetails },
  { path: "email-templates/:emailTemplateID/edit-email-template", name: "OLTsEmailTemplateEditTemplate", component: OLTsEmailTemplateEditTemplate },
  { path: "sms-templates", name: "OLTsSMSTemplateAllTemplates", component: OLTsSMSTemplateAllTemplates },
  { path: "sms-templates/create-template", name: "OLTsSMSTemplateCreateTemplate", component: OLTsSMSTemplateCreateTemplate },
  { path: "sms-templates/:smsTemplateID", name: "OLTsSMSTemplateTemplateDetails", component: OLTsSMSTemplateTemplateDetails },
  { path: "sms-templates/:smsTemplateID/edit-sms-template", name: "OLTsSMSTemplateEditTemplate", component: OLTsSMSTemplateEditTemplate }
]

const oltsEmailsRoutes = [

]

const chatRoutes = [
  { path: "chats/:recipientID", name: "ChatManagerApplication", component: ChatManagerApplication },
]

const tailorsRoutes = [
  { path: "", name: "TailorUserAccountDashboard", component: TailorUserAccountDashboard },

]

const serviceRoutes = [
  { path: "", name: "ServiceUserAccountDashboard", component: ServiceUserAccountDashboard },
  { path: "new-transaction", name: "ServiceUserRegisterNewTransaction", component: ServiceUserRegisterNewTransaction },
  { path: "transactions", name: "ServiceUserRegisteredTransactions", component: ServiceUserRegisteredTransactions },
]

const laundryRoutes = [
  { path: "", name: "LaundryUserAccountDashboard", component: LaundryUserAccountDashboard },
  { path: "new-transaction", name: "LaundryUserRegisterNewTransaction", component: LaundryUserRegisterNewTransaction },
  { path: "transactions", name: "LaundryUserRegisteredTransactions", component: LaundryUserRegisteredTransactions },
]

const profileRoutes = [
  { path: "profile-details", name: "LoggedUserProfileDetails", component: LoggedUserProfileDetails },
  { path: "edit-profile", name: "EditLoggedUserProfileDetails", component: EditLoggedUserProfileDetails },
  { path: "change-password", name: "LoggedUserChangeProfilePassword", component: LoggedUserChangeProfilePassword },
  { path: "change-profile-image", name: "LoggedUserChangeProfileImage", component: LoggedUserChangeProfileImage },
]

const settingsRoutes = [
  { path: "general-settings", name: "GeneralSettings", component: GeneralSettings },
]

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "ManagementLogin",
    component: ManagementLogin,
    meta: {
      requiresVisitor: true
    }
  },{
    path: '/manager-services/:loggedUserID',
    component: ManagersComponent,
    children: managersRoutes,
    meta: {
        requiresAuth: true,
    }
  },{
    path: '/tailor-services/:loggedUserID',
    component: TailorsComponent,
    children: tailorsRoutes,
    meta: {
        requiresAuth: true,
    }
  },{
    path: '/frontdesk-services/:loggedUserID',
    component: ServiceComponent,
    children: serviceRoutes,
    meta: {
        requiresAuth: true,
    }
  },{
    path: '/laundry-services/:loggedUserID',
    component: LaundryComponent,
    children: laundryRoutes,
    meta: {
        requiresAuth: true,
    }
  },{
    path: '/:loggedUserRouteDetails/:loggedUserID/chats',
    component: ApplicationChatRoot,
    children: chatRoutes,
    meta: {
        requiresAuth: true,
    }
  },{
    path: '/:loggedUserRouteDetails/:loggedUserID/emails',
    component: ApplicationEmailRoot,
    children: emailsRoutes,
    meta: {
        requiresAuth: true,
    }
  },{
    path: '/:loggedUserRouteDetails/:loggedUserID/profile',
    component: ApplicationProfileRoot,
    children: profileRoutes,
    meta: {
        requiresAuth: true,
    }
  },{
    path: '/:loggedUserRouteDetails/:loggedUserID/settings',
    component: ApplicationSettingsRoot,
    children: settingsRoutes,
    meta: {
        requiresAuth: true,
    }
  },{
    path: '/manager-services/:loggedUserID/olts-emails',
    component: ApplicationEmailRoot,
    children: oltsEmailsRoutes,
    meta: {
        requiresAuth: true,
    }
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

export default router;
