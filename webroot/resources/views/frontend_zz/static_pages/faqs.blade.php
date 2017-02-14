@extends('frontend_zz.layouts.app')

@section('title', trans('users::global.FAQS') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

<section class="cards-grid">
    <div class="row cyan-gradient">
	    <div class="content-page">
		    <div class="container">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 title">
                    <h1>FAQ's</h1>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 content">
                    <h2>FAQ's Gadget</h2>

                    <div class="faq-collapse">
                        <h3 data-toggle="collapse" data-target="#gadget-faq1">1: Do I still need Gadget insurance if I already have a manufacturer’s warranty? </h3>
                        <div id="gadget-faq1" class="collapse">
                            <p>Manufacturers warranties are designed to cover mechanical breakdown you won’t be covered during those 12 months for cracked screens, liquid damage, accidental damage or theft. Even extended warranties generally don’t cover these events. We cover all of them as standard (subject to the policy limit).</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq2">2: How old do I have to be to take out the insurance?</h3>
                        <div id="gadget-faq2" class="collapse">
                            <p>You must be a minimum of 18 years old and a resident of the UK, Channel Islands or IOM to take out a Gadget Insurance policy with us. </p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq3">3: How can I cancel my policy?</h3>
                        <div id="gadget-faq3" class="collapse">
                            <p>You can cancel your policy at any time by contacting the call centre on <span>0800 1977 218</span></p>
                            <p>If you cancel your policy within the first 14 days, you will get a full Insurance refund, however if you have activated and used your ZnapCard, you will be charged a £25 administration fee for use of the card.</p>
                            <p>For customers who have paid annually, after the first 14 days, provided no claim has been made and settlement terms subsequently agreed, we will cancel the policy and you will receive a pro rata refund for each unexpired month of premium paid. For example, if you have an annual premium of £130 and request that your policy is cancelled during the seventh month, you will be entitled to a refund the remaining five months premium. This will be calculated as 5/12th of the premium you have paid as follows: The premium taken for a policy is £130, therefore the refund would be £130/12 x 5 = £54.16.</p>
                            <p>For customers who pay by instalments, after the first 14 days, provided no claim has been made and settlement terms subsequently agreed, we will cancel the policy from the monthly anniversary of the start date. We will then calculate the pro rata premium due up until the cancellation date and refund you the difference between that and the amount already paid by yourself. For example, you cancel during the third month and have paid your deposit (£66) plus once further instalment (£14). You will be charged 3/12ths of the £130 annual premium which is £32.50 and since you will have paid £80, we will refund you £47.50.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq4">4: How can I pay for my policy?</h3>
                        <div id="gadget-faq4" class="collapse">
                            <p>You can pay the upfront fee of £130.00 by debit or credit card; or £72.00 followed by 4 monthly instalments of £14.50 by debit/credit card. </p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq5">5: Who is insurer?</h3>
                        <div id="gadget-faq5" class="collapse">
                            <p>Nova Insurance, a trading name of Premier Insurance Consultants Ltd.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq6">6: What happens if you decide to replace my gadget?</h3>
                        <div id="gadget-faq6" class="collapse">
                            <p>If we decide to replace the mobile device instead of repair it, the replacement may be a re-manufactured (not brand new) device. We will attempt to replace your device with one of the same colour but we can’t guarantee to do this or replace any limited or special edition mobile devices. Where we send you a replacement or repaired item, this will only be sent to a UK, Channel Islands or IOM address.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq7">7: Who is this cover designed for?</h3>
                        <div id="gadget-faq7" class="collapse">
                            <p>This policy is designed for people who don't have their gadget insured elsewhere and who want to cover the costs of repair or replacement should the item breakdown outside of the manufacturer’s warranty, be damaged, lost or stolen.</p>
                            <p>As with most insurance policies, an excess is applicable and limitations and exclusions apply. This cover is provided on the condition that you are a UK, Channel Islands or IOM resident and over 18 years of age.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq8">8: If I arrange to repair my gadget myself will you pay for the costs?</h3>
                        <div id="gadget-faq8" class="collapse">
                            <p>No, we only want your gadget to get high-quality repairs, which is why we only use our approved repairers. We also want the ability for us to assess the damage to your gadget in order to best decide whether to repair or replace the gadget.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq9">9: What documents will I receive when I purchase a policy?</h3>
                        <div id="gadget-faq9" class="collapse">
                            <p>We do not send a printed version of your Policy wording and Summary as it helps us to be more environmentally friendly. Instead, you will receive an email from us with your Schedule of Insurance and policy documents. Alternatively you can find your policy documents in the ‘my policies section’.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq10">10: Does it matter where I bought my gadget from?</h3>
                        <div id="gadget-faq10" class="collapse">
                            <p>We will only insure Gadgets that are:</p>
                            <ul class="list">
                                <li>purchased as new in the UK, Channel Islands or IOM or;</li>
                                <li>purchased as refurbished in the UK, Channel Islands or IOM direct from the manufacturer or network provider or;</li>
                                <li>gifted to You as long as You are able to provide Proof of Purchase and;</li>
                                <li>not more than 36 months old at the time the policy was first purchased and You are able to supply Evidence of Ownership if requested.</li>
                            </ul>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq11">11: Is there an age limit for the gadgets I want to insure?</h3>
                        <div id="gadget-faq11" class="collapse">
                            <p>Yes – if you’re starting a new gadget policy or adding a gadget to an existing policy, your item/items need to be less than 36 months old.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq12">12: Who does my policy cover?</h3>
                        <div id="gadget-faq12" class="collapse">
                            <p>This insurance is for gadgets that are owned by the policyholder. </p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq13">13: Are cosmetic damages covered?</h3>
                        <div id="gadget-faq13" class="collapse">
                            <p>We only cover damage if it stops the normal functioning of your gadget. Cracked screens are covered, but if your gadget has only suffered a scratch or dent, and still works as expected, then we will not repair or replace it.</p>
                        </div>


                        <h3 data-toggle="collapse" data-target="#gadget-faq14">14: What types of gadgets do you insure?</h3>
                        <div id="gadget-faq14" class="collapse">
                            <p>We offer insurance on mobile phones (including iPhones), iPads, tablets, phablets, satellite navigation units, iPods, MP3 players, laptops, cameras, portables DVD players, portable gaming consoles, or LCD monitors.. Cover restrictions vary depending on the gadget – please see the policy wording for full details. If you have any other items that you would like to insure, please email us at <a href="mailto:help@zugarznap.com">help@zugarznap.com</a></p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq15">15: Do you cover contract phones?</h3>
                        <div id="gadget-faq15" class="collapse">
                            <p>Yes, we do cover contract phones.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq16">16: If I leave my gadget unattended and something happens to it, am I still covered?</h3>
                        <div id="gadget-faq16" class="collapse">
                            <p>If you need to leave your gadget somewhere then we expect you to lock it away out of sight if at all possible. If you cannot lock it away then you must leave it with someone you trust or concealed out of sight in a safe place.</p>
                            <p>If you knowingly leave your gadget where others can see it (but you cannot) and your gadget is then lost or stolen, we may not pay your claim.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq17">17: Am I covered whilst I am away on holiday?</h3>
                        <div id="gadget-faq17" class="collapse">
                            <p>Yes – your device will be covered worldwide for up to 30 days. Please note that replacements can only be sent to UK, Channel Islands or IOM addresses.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq18">18: Am I covered for incidents that occurred before my policy started?</h3>
                        <div id="gadget-faq18" class="collapse">
                            <p>No, any incident prior to the start date of your insurance will not be covered.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq19">19: My gadget is still under the manufacturer’s warranty - will you cover it?</h3>
                        <div id="gadget-faq19" class="collapse">
                            <p>You will be able to take out insurance with us, but if a problem occurs that is covered by the manufacturer’s warranty, we will advise you to follow the warranty returns process as specified by the manufacturer.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq20">20: Does it matter how I treat my gadget?</h3>
                        <div id="gadget-faq20" class="collapse">
                            <p>Yes – having insurance does not mean that you can take risks with your gadget which you would not take if your gadget was not insured. Doing so may result in your claim being declined. It is important to note that gadget insurance is offered on the understanding that you will take care of your gadget.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq21">21: Will you cover for unauthorised call charges?</h3>
                        <div id="gadget-faq21" class="collapse">
                            <p>Yes - If your mobile phone is accidentally lost or stolen and is used fraudulently, We will reimburse You for the costs up to a maximum value of £500 upon receipt of your itemised bill, provided you have reported the claim within 24 hours. This is in addition to the Policy limit stated on your certificate of insurance.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq22">22: Do you back up any information on my gadget?</h3>
                        <div id="gadget-faq22" class="collapse">
                            <p>No, we only cover the gadget, we don’t cover the contents.  This means that any pictures, software, downloads, apps, music or any other content is not covered by this policy, so make sure you back it up regularly.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq23">23: Will you cover my accessories that I have put on my gadget?</h3>
                        <div id="gadget-faq23" class="collapse">
                            <p>No, we only cover the gadget itself – we do not cover any accessories.</p>
                            <p>Accessories include:</p>
                            <p><span>Cases</span></p>
                            <p><span>Headphones/earphones</span></p>
                            <p><span>Chargers</span></p>
                            <p><span>External charging devices</span></p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq24">24: I use my gadget for work, will you pay for loss of earnings?</h3>
                        <div id="gadget-faq24" class="collapse">
                            <p>No, we don’t cover any loss of profit, opportunity, subscription fees, line rental, goodwill or similar losses. We just cover the gadget and any unauthorised call charges.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq25">25: I've modified my gadget, will you cover the cost of this?</h3>
                        <div id="gadget-faq25" class="collapse">
                            <p>No, if your gadget has been modified in any way we will only replace the gadget, we do not cover the modifications that have been made.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq26">26: Why do I need to provide a proof of ownership if I want to claim?</h3>
                        <div id="gadget-faq26" class="collapse">
                            <p>In order to reduce fraud, we need to know that the gadget you are claiming for is yours Therefore you will need to provide some form of proof of ownership.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq27">27: Will you cover shipping charges if my item needs repair?</h3>
                        <div id="gadget-faq27" class="collapse">
                            <p>Yes – we’ll send you prepaid packaging and cover the shipping costs if we confirm that your device is in need of repairs.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq28">28: My gadget was stolen and I've bought another one. Will you reimburse me for it?</h3>
                        <div id="gadget-faq28" class="collapse">
                            <p>No – in the event of a theft, you should notify your network provider and get your phone blacklisted, as well as notifying the police to obtain a crime reference number. Once you provide us with that information, we will facilitate the replacement of your gadget. If you purchase your own replacement we will be unable to reimburse you for that cost.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq29">29: What is my gadget's IMEI number and where can I find it?</h3>
                        <div id="gadget-faq29" class="collapse">
                            <p>Every mobile phone has a unique IMEI number: or “International Mobile Station Equipment Identity” number. It can be found by dialing “*#06#” on most phones, and is also often printed inside the battery compartment of a phone. Your phone’s IMEI number can usually be found within your settings menu as well.</p>
                            <p>For items other than mobiles phones, you’ll need the serial number – a unique code assigned to a gadget for identification.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq30">30: Why do I need my gadget's IMEI or serial number?</h3>
                        <div id="gadget-faq30" class="collapse">
                            <p>Collecting this number helps us reduce the incidence of insurance fraud – which means we can offer insurance at lower premiums. It also means quicker processing in the event of making a claim.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq31">31: Do I need to report the theft or loss of my gadget to the police?</h3>
                        <div id="gadget-faq31" class="collapse">
                            <p>Yes – tell the police about any lost or stolen gadget as soon as you can. We will ask you to provide the police reference number before we will pay any claim for loss and theft.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq32">32: Do I need to report the theft or loss of my phone to my network provider?</h3>
                        <div id="gadget-faq32" class="collapse">
                            <p>Yes – tell your network provider as soon as you can so they can block your device and SIM card as soon as possible. We also may ask for evidence of this to support any claim for the loss or theft of your gadget. We only pay for unauthorised network charges from the point your gadget is lost or stolen up to 24 hours after you discover the loss or theft – if you don’t tell your airtime provider within 24 hours you will be responsible for any further charges.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq33">33: If my gadget can’t be repaired and a replacement is necessary, will my replacement be brand-new or refurbished?</h3>
                        <div id="gadget-faq33" class="collapse">
                            <p>This is not a replacement-as-new policy, therefore your replacement gadget may be refurbished. If your gadget cannot be repaired, or replaced with an identical one of the same age and condition, we will replace it with a comparable or equivalent device, taking into account the age and condition of the original gadget.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq34">34: How do I make a claim?</h3>
                        <div id="gadget-faq34" class="collapse">
                            <p>Direct customer to claims page on the website/app.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq35">35: Is there an excess ?</h3>
                        <div id="gadget-faq35" class="collapse">
                            <p>Yes – there is an excess fee for all successful claims which must be paid before your claim can be approved.</p>
                            <p>Excess’s vary depending on the value of the gadget as per the below:</p>

                            <table class="tg">
                                <thead>
                                    <tr>
                                        <th class="tg-ds4c">Type of Incident</th>
                                        <th class="tg-ds4c">Excess</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="tg-ds4c">Accidental Damage / Breakdown</td>
                                        <td class="tg-ds4c">£25</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-ds4c">Theft</td>
                                        <td class="tg-ds4c">£25</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-ds4c">Accidental Loss</td>
                                        <td class="tg-ds4c">£50</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq36">36: What is acceptable proof of ownership?</h3>
                        <div id="gadget-faq36" class="collapse">
                            <p>Proof of ownership could include a till receipt or documentation from any online purchase, or in the case of mobile phones, documentation from your network provider. If you don’t have any proof of ownership we may decline your claim.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#gadget-faq37">37: Is there a limit to how many times I can claim?</h3>
                        <div id="gadget-faq37" class="collapse">
                            <p>You can claim twice in a year however the maximum aggregate amount we will pay is the amount shown on your certificate of insurance.</p>
                        </div>





                        <div>&nbsp;</div>
                        <div>&nbsp;</div>

                        <div>
                            <p>Our Gadget Policies are underwritten by:</p>
                            <p>Premier Insurance Consultants Ltd trading as Nova Insurance on behalf of Evolution Insurance Company Limited. Evolution Insurance Company Limited is registered at Level 2, Ocean Village Business Centre, 23 Ocean Village Promenade, Gibraltar.</p>
                            <p>Evolution Insurance Company Limited (Company No. 88737) is authorized and regulated in Gibraltar by the Gibraltar Financial Services Commission and is permitted to issue policies in the UK by the UK Financial Conduct Authority under FCA number 227649</p>
                        </div>








                        <div>&nbsp;</div>
                        <div>&nbsp;</div>
                        <div>&nbsp;</div>
                        <h2>FAQ's XS</h2>

                        <h3 data-toggle="collapse" data-target="#xs-faq1">1: Can’t I just purchase a motor insurance policy with no excess?</h3>
                        <div id="xs-faq1" class="collapse">
                            <p>Policies without an excess are hard to find. The Excess is the way of insurance companies makes sure they cover their back, by sharing the risk with their customers. So you have a stake in the same risk and the excess discourages multiple small claims.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#xs-faq2">2: If I stay claims free, won’t my excess come down anyway?</h3>
                        <div id="xs-faq2" class="collapse">
                            <p>Staying claims free can help reduce the premiums you have to pay. But it’s unlikely as excess limits are not usually calculated on whether you have made a claim in the last year.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#xs-faq3">3: How much excess protection can I have?</h3>
                        <div id="xs-faq3" class="collapse">
                            <p>We offer policies ranging from £250 right up to £3,000 so you should have no difficulty in finding the cover for you.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#xs-faq4">4: Will I face investigation if I make a claim?</h3>
                        <div id="xs-faq4" class="collapse">
                            <p>Excess protection is simple: if your Motor Insurer pays out, so will your excess protection policy. Any investigation into your claim will be done by your motor insurer.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#xs-faq5">5: Why purchase excess Protection?</h3>
                        <div id="xs-faq5" class="collapse">
                            <p>If you have a successful claim on your main motor policy, you will need to pay out the excess on your policy. Excess protection will reimburse you the amount.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#xs-faq6">6: Will I be covered for any excess I have to pay?</h3>
                        <div id="xs-faq6" class="collapse">
                            <p>Yes - up to the annual limit you have opted for on your excess cover policy. Note that every insurance policy has terms and conditions, which you need to, read and be aware of.</p>
                            <p>In the case of excess protection, if your main motor insurance policy pays out we will reimburse you. If the claim is not accepted, then you can’t claim on your excess cover.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#xs-faq7">7: Can I still claim on my excess protection policy if my claim is less than my excess limit?</h3>
                        <div id="xs-faq7" class="collapse">
                            <p>No. Your excess protection policy will only pay out if your Motor Insurer pays your claim.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#xs-faq8">8: Can I claim for something that happened before I bought excess protection?</h3>
                        <div id="xs-faq8" class="collapse">
                            <p>No. Your excess cover needs to be active at the time as when the loss took place. The claim needs be between the two dates on your certificate.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#xs-faq9">9: Does my motor excess protection cover just the policyholder or any driver?</h3>
                        <div id="xs-faq9" class="collapse">
                            <p>It doesn’t matter who was driving as long as your motor insurance policy pays out, you can claim on your excess protection cover.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#xs-faq10">10: If I have had a previous conviction or accidents, can I purchase excess protection?</h3>
                        <div id="xs-faq10" class="collapse">
                            <p>You can have excess protect as long as you live in the UK, Channel Islands and IOM have a full drivers licence and have an active motor policy.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#xs-faq11">11: If my motor insurance policy includes legal expenses and they pay my excess, can I still claim on my excess protection policy?</h3>
                        <div id="xs-faq11" class="collapse">
                            <p>No. Insurance is there to protect you from financial losses you may suffer - not to make you money. You are no longer out of pocket if another insurer has already given you your excess back.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#xs-faq12">12: If I recover 50% of the excess after being involved in a joint liability accident, can I claim the other half of my excess?</h3>
                        <div id="xs-faq12" class="collapse">
                            <p>Yes. You have suffered an actual loss and can reclaim the missing half of your excess.</p>
                        </div>

                        <h3 data-toggle="collapse" data-target="#xs-faq13">13: How do I make a complaint?</h3>
                        <div id="xs-faq13" class="collapse">
                            <p>See complaints page</p>
                        </div>


                        <div>&nbsp;</div>
                        <div>&nbsp;</div>

                        <div>
                            <p>Our XS policies are underwritten by:</p>
                            <p>Premier Insurance Consultants Ltd trading as Nova Insurance on behalf of Evolution Insurance Company Limited. Evolution Insurance Company Limited is registered at Level 2, Ocean Village Business Centre, 23 Ocean Village Promenade, Gibraltar.</p>
                            <p>Evolution Insurance Company Limited (Company No. 88737) is authorized and regulated in Gibraltar by the Gibraltar Financial Services Commission and is permitted to issue policies in the UK by the UK Financial Conduct Authority under FCA number 227649</p>
                        </div>

                        <div>&nbsp;</div>
                        <div>&nbsp;</div>

                    </div>

                    <div class="back-button">
                        <button class="btn btn-yellow" onclick="goBack(); return false;">Back</button>
                    </div>
                </div>
            </div>
		</div>
	</div>
</section>

@endsection