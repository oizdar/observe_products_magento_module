#Magento module: 
**_Magento 1.9_**
###Add products to inform about availability.

######Short module description:

* This module adds form under product description, when shop product isn't available in stock. 
(Shop settings must allow to show unavailable products).
* Form have one field email and button: ``inform me about product availability``. But if user is logged 
then only button is shown.
* Not logged users can't use registered customers e-mails.
* If product is already subscribed for chosen e-mail then suitable message is showing.
* If user is logged and product is added to observe, then suitable message is shown instead form.
* Registered users have additional page in user-panel with list of all observed items.
* Administrator have additional grid with all observed products. Can see which emails belongs 
/or not to registered users.

#####Next steps:
- Remove observed products by user:
    + Add button on product page.
    * Add button on user-panel page.
- Sending emails from administration panel (by click or automatic on product availability update)