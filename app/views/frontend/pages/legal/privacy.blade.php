@extends($project->present()->templatePath.'.master')

{{-- Page title --}}
@section('title')
	Privacy Policy
@stop

{{-- Subtitle --}}
@section('subtitle')

@stop

@section('content_wrapped')
	<p>{{ $project->website_title }} understands that privacy online is important to users of our Site, especially when conducting business. This statement governs our privacy policies with respect to those users of the Site ("Visitors") who visit without transacting business and Visitors who register to transact business on the Site and make use of the various services offered by {{ $project->website_title }} (collectively, "Services") ("Authorized Customers").</p>
	<p>"Personally Identifiable Information" refers to any information that identifies or can be used to identify, contact, or locate the person to whom such information pertains, including, but not limited to, name, address, phone number, fax number, email address, financial profiles, social security number, and credit card information. Personally Identifiable Information does not include information that is collected anonymously (that is, without identification of the individual user) or demographic information not connected to an identified individual.</p>
	<p><strong>What Personally Identifiable Information is collected? </strong></p>
	<p>We may collect basic user profile information from all of our Visitors. We collect the following additional information from our Authorized Customers: the names, addresses, phone numbers and email addresses of Authorized Customers, the nature and size of the business, and the nature and size of the advertising inventory that the Authorized Customer intends to purchase or sell.</p>
	<p><strong>What organizations are collecting the information? </strong></p>
	<p>In addition to our direct collection of information, our third party service vendors (such as credit card companies, clearinghouses and banks) who may provide such services as credit, insurance, and escrow services may collect this information from our Visitors and Authorized Customers. We do not control how these third parties use such information, but we do ask them to disclose how they use personal information provided to them from Visitors and Authorized Customers. Some of these third parties may be intermediaries that act solely as links in the distribution chain, and do not store, retain, or use the information given to them.</p>
	<p><strong>How does the Site use Personally Identifiable Information?</strong></p>
	<p>We use Personally Identifiable Information to customize the Site, to make appropriate service offerings, and to fulfill buying and selling requests on the Site. We may email Visitors and Authorized Customers about research or purchase and selling opportunities on the Site or information related to the subject matter of the Site. We may also use Personally Identifiable Information to contact Visitors and Authorized Customers in response to specific inquiries, or to provide requested information.</p>
	<p><strong>With whom may the information may be shared?</strong></p>
	<p>Personally Identifiable Information about Authorized Customers may be shared with other Authorized Customers who wish to evaluate potential transactions with other Authorized Customers. We may share aggregated information about our Visitors, including the demographics of our Visitors and Authorized Customers, with our affiliated agencies and third party vendors. We also offer the opportunity to "opt out" of receiving information or being contacted by us or by any agency acting on our behalf.</p>
	<p><strong>How is Personally Identifiable Information stored?</strong></p>
	<p>Personally Identifiable Information collected by {{ $project->website_title }} is securely stored and is not accessible to third parties or employees of {{ $project->website_title }} except for use as indicated above.</p>
	<p><strong>What choices are available to Visitors regarding collection, use and distribution of the information?</strong></p>
	<p>Visitors and Authorized Customers may opt out of receiving unsolicited information from or being contacted by us and/or our vendors and affiliated agencies by responding to emails as instructed.</p>
	<p><strong>Are Cookies Used on the Site?</strong></p>
	<p>Cookies are used for a variety of reasons. We use Cookies to obtain information about the preferences of our Visitors and the services they select. We also use Cookies for security purposes to protect our Authorized Customers. For example, if an Authorized Customer is logged on and the site is unused for more than 10 minutes, we will automatically log the Authorized Customer off.</p>
	<p><strong>How does {{ $project->website_title }} use login information? </strong></p>
	<p>{{ $project->website_title }} uses login information, including, but not limited to, IP addresses, ISPs, and browser types, to analyze trends, administer the Site, track a user's movement and use, and gather broad demographic information.</p>
	<p><strong>What partners or service providers have access to Personally Identifiable Information from Visitors and/or Authorized Customers on the Site?</strong></p>
	<p>{{ $project->website_title }} has entered into and will continue to enter into partnerships and other affiliations with a number of vendors. Such vendors may have access to certain Personally Identifiable Information on a need to know basis for evaluating Authorized Customers for service eligibility. Our privacy policy does not cover their collection or use of this information.</p>
	<p>Disclosure of Personally Identifiable Information to comply with law. We will disclose Personally Identifiable Information in order to comply with a court order or subpoena or a request from a law enforcement agency to release information. We will also disclose Personally Identifiable Information when reasonably necessary to protect the safety of our Visitors and Authorized Customers.</p>
	<p><strong>How does the Site keep Personally Identifiable Information secure?</strong></p>
	<p>All of our employees are familiar with our security policy and practices. The Personally Identifiable Information of our Visitors and Authorized Customers is only accessible to a limited number of qualified employees who are given a password in order to gain access to the information. We audit our security systems and processes on a regular basis. Sensitive information, such as credit card numbers or social security numbers, is protected by encryption protocols, in place to protect information sent over the Internet. While we take commercially reasonable measures to maintain a secure site, electronic communications and databases are subject to errors, tampering and break-ins, and we cannot guarantee or warrant that such events will not take place and we will not be liable to Visitors or Authorized Customers for any such occurrences.</p>
	<p><strong>How can Visitors correct any inaccuracies in Personally Identifiable Information?</strong></p>
	<p>Visitors and Authorized Customers may contact us, or 3rd parties affiliated with {{ $project->website_title }}, to update Personally Identifiable Information about them, or to correct any inaccuracies. To do this, please follow instruction, in any correspondence you have received via email. Instructions will typically be at the bottom of the email.</p>
	<p><strong>Can a Visitor delete or deactivate Personally Identifiable Information collected by the Site?</strong></p>
	<p>We provide Visitors and Authorized Customers with a mechanism to delete/deactivate Personally Identifiable Information from the Site's database by contacting . However, because of backups and records of deletions, it may be impossible to delete a Visitor's entry without retaining some residual information. An individual who requests to have Personally Identifiable Information deactivated will have this information functionally deleted, and we will not sell, transfer, or use Personally Identifiable Information relating to that individual in any way moving forward.</p>
	<p><strong>What happens if the Privacy Policy Changes?</strong></p>
	<p>We will let our Visitors and Authorized Customers know about changes to our privacy policy by posting such changes on the Site. However, if we are changing our privacy policy in a manner that might cause disclosure of Personally Identifiable Information that a Visitor or Authorized Customer has previously requested not be disclosed, we will contact such Visitor or Authorized Customer to allow such Visitor or Authorized Customer to prevent such disclosure.</p>
	<p><strong>Links:</strong></p>
	<p>{{ $project->website_title }} contains links to other web sites. Please note that when you click on one of these links, you are moving to another web site. We encourage you to read the privacy statements of these linked sites as their privacy policies may differ from ours.</p>
	<p>DoubleClick DART Cookie</p>
	<p><strong>What is the DoubleClick cookie doing on my computer? </strong></p>
	<p>If you have a DoubleClick cookie in your Cookies folder, it is most likely a DART cookie. The DoubleClick DART cookie helps marketers learn how well their Internet advertising campaigns or paid search listings perform. Many marketers and Internet websites use DoubleClick's DART technology to deliver and serve their advertisements or manage their paid search listings. DoubleClick's DART products set or recognize a unique, persistent cookie when an ad is displayed or a paid listing is selected. The information that the DART cookie helps to give marketers includes the number of unique users their advertisements were displayed to, how many users clicked on their Internet ads or paid listings, and which ads or paid listings they clicked on.</p>
	<p><strong>Why does your cookie keep coming back after I delete it? </strong></p>
	<p>When you visit any website or search engine on which DoubleClick's DART technology is used, our servers will check to see if you already have a DART cookie. If the servers do not receive a DART cookie, the servers will try to set a cookie in response to your browser's "request" to view that Web page. If you do not want a DART cookie with a unique value, you can obtain a DoubleClick DART "opt out" cookie. Alternatively, you can adjust your Internet browser's settings for handling cookies. This is explained in the next question.</p>
	<p><strong>How can I adjust my cookie settings to accept or decline cookies?</strong></p>
	<p>To eliminate cookies you may have currently accepted, and to deny or limit cookies in the future, please follow one of these procedures:</p>
	<p>IMPORTANT: IF YOU DELETE YOUR OPT-OUT COOKIE, YOU WILL NEED TO OPT-OUT AGAIN. IF YOUR BROWSER BLOCKS ALL OR THIRD-PARTY COOKIES, YOU WILL BLOCK THE SETTING OF OPT-OUT COOKIES.</p>
	<p>* If you are using Internet Explorer 6.0, go to the Tools menu, then to Internet Options, then to the Privacy tab. This version of Internet Explorer is the first to use P3P to distinguish between types of cookies. P3P uses standardized privacy statements made by the cookie issuer to manage your acceptance of cookies. Under the "Privacy" tab, click on the "Advanced" button. Select "Override automatic cookie handling" and choose whether you want to accept, block or be prompted for "First-party" and "Third-party Cookies." If you want to block all cookies coming from DoubleClick's doubleclick.net domain, go to the "Web Sites" section under the "Privacy" tab and click the "Edit" button. In the "Address of Web site" field, enter "doubleclick.net," select "Block," click OK (menu will disappear); click OK again and you will be back to the browser.</p>
	<p>* If you are using Netscape 6.0+, go to "Edit" in the menu bar, click on "Preferences," click on "Advanced," and select the "Cookies" field. Now check either the box that says, "Warn me before accepting a cookie" or "Disable cookies." Click on "OK." Now go to your "Start" button, click on "Find," click on "Files and Folders," type "cookies.txt" into the search box that appears, and click "Find Now." When the search results appear, drag all files listed, into the "Recycle Bin." Now shut down and restart your Netscape. Depending on your earlier choice you will either be prompted by new cookie sets or no cookies will be set or received.* If you are using Mozilla or Safari, please go to their websites to find out how to disable cookies in those programs.</p>
@stop