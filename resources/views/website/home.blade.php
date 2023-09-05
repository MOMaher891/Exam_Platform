@extends('layouts.website.layout')
@section('title','Exam Platform')
@section('content')

<main class="main">
    <header id="Introduction" class="header wf-section">
        <div class="container w-container">
            <div class="w-layout-grid grid-two introduction">
                <div class="introduction-headings">
                    <h1>Workplace Wellbeing</h1>
                    <p class="subheading">A platform to facilitate examination invigilators</p>
                </div><img
                    src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/6102a5804733360b13bd1fd4_great-minds-introduction-working.svg"
                    loading="lazy" id="w-node-_749094cd-3351-73b1-4786-0f89e0b5a528-0862c5d4"
                    alt="Office workers enjoying nature and relaxing" class="introduction-illustration" />
            </div>
        </div>
    </header>
    {{-- <section class="xl-gap wf-section">
        <div class="container w-container">
            <div class="w-layout-grid grid-four">
                <div id="w-node-_5e6b692d-801f-8c96-0952-0b35636ec606-0862c5d4" class="relative organic-wrapper">
                    <div data-w-id="c34f6110-7ab3-36b4-dd32-6fe61dbf3389"
                        style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0)"
                        class="organic-background"></div>
                    <div data-w-id="7edbff0e-4c3e-183b-2fbd-66ddb5d69d0f"
                        style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(50deg) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(50deg) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(50deg) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(50deg) skew(0, 0)"
                        class="organic-foreground"></div>
                    <div class="organic yohan"><img
                            src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/6101cbb13cd0dd052cbd475b_mhfa-instructor-badge.svg"
                            loading="lazy" alt="MHFA Instructor Member Badge" class="mhfa-badge" /></div>
                </div>
                <div>
                    <h2>Hello, I&#x27;m Yohan</h2>
                    <p>Through Great Minds I provide proven mental health and wellbeing solutions to organisations.
                        Each course is designed to help your business increase productivity, reduce absenteeism and
                        improve overall health, performance and resilience of your employees.</p><a href="#"
                        class="button xl-gap w-button">Contact me</a>
                </div>
                <div id="w-node-_14eda021-b872-0191-e91a-ec9c158f5fd5-0862c5d4" class="relative organic-wrapper">
                    <div data-w-id="14eda021-b872-0191-e91a-ec9c158f5fd6"
                        style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0)"
                        class="organic-background tips"></div>
                    <div data-w-id="14eda021-b872-0191-e91a-ec9c158f5fd7"
                        style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(50deg) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(50deg) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(50deg) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(50deg) skew(0, 0)"
                        class="organic-foreground tips"></div>
                    <div class="organic tips"></div><img
                        src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/6101ccb2eed367ee78c19d16_wellness-tips-illustration.svg"
                        loading="lazy" width="238" alt="Wellness Tips Illustration" class="wb-tips-illustration" />
                </div>
                <div>
                    <h2>Free wellbeing tips</h2>
                    <p>Receive free wellbeing tips in your inbox every week for a year. Each tip is based on my work
                        with organisations to provide proven mental health and wellbeing solutions. They are
                        designed to help you increase your productivity, health, creativity and resilience.</p><a
                        data-w-id="31f14631-fbc7-f3f1-cc02-77cab7aa5a0c" href="#" class="button w-button">Free
                        wellbeing tips</a>
                </div>
            </div>
        </div>
    </section> --}}
    {{-- <section id="Benefits" class="xl-gap wf-section">
        <div class="container w-container">
            <h2>Transform your team</h2>
            <div class="w-layout-grid grid-three">
                <div class="feature-wrapper"><img
                        src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/61004406b605fd16f533b8a6_mental-health-wellbeing-training.svg"
                        loading="lazy" width="120" height="120" alt="Mental health &amp; wellbeing training" />
                    <h3> Mental health &amp; wellbeing training </h3>
                    <p>Whether your workforce has unmanageable levels of stress, individuals that require skills to
                        help support others emotionally, or is simply in need of some effective wellbeing tips,
                        Great Minds can help you.</p>
                </div>
                <div class="feature-wrapper"><img
                        src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/610044069ab6908c97fce652_positive-training-experience.svg"
                        loading="lazy" width="120" height="120" alt="Tangible business benefits" />
                    <h3>Tangible business benefits</h3>
                    <p>The training we deliver increases productivity, reduces absence, reduces staff turnover, and
                        helps create an open healthy and happy workforce.</p>
                </div>
                <div class="feature-wrapper"><img
                        src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/610044069f63d42429095115_tangible-business-benefits.svg"
                        loading="lazy" width="120" height="120" alt="Positive training experience" />
                    <h3> Positive training experience</h3>
                    <p>You will leave our training full of new ideas and information that you can implement straight
                        away. Our training is motivating, engaging and fun delivered in an interactive way through a
                        variety of activities and group discussions.</p>
                </div>
                <div class="feature-wrapper"><img
                        src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/61004406ed607b6cff48225f_develop-your-wellbeing-strategy.svg"
                        loading="lazy" width="120" height="120" alt="Develop your wellbeing strategy" />
                    <h3> Develop your wellbeing strategy</h3>
                    <p>Great Minds can look at the health and wellbeing of your organisation as a whole and build,
                        develop and implement a wellbeing strategy to fit your needs.</p>
                </div>
                <div class="feature-wrapper"><img
                        src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/6100440670493706fba22711_highly-experienced-trainer.svg"
                        loading="lazy" width="120" height="120" alt="Highly experienced trainer" />
                    <h3> Highly experienced trainer</h3>
                    <p>You can expect to be in the safe hands of a trainer with many years’ experience in delivering
                        wellbeing training, alongside extensive corporate experience, and an inspiring personal
                        journey.</p>
                </div>
                <div class="feature-wrapper"><img
                        src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/610044069b7545647841852b_safe-environment.svg"
                        loading="lazy" width="120" height="120" alt="Safe environment" />
                    <h3> Safe environment</h3>
                    <p>Your comfort and safety are paramount when attending our courses. We are experts in creating
                        a safe and confidential environment to help facilitate learning.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="xl-gap wf-section">
        <div class="container w-container">
            <h2>Our customers</h2>
            <div class="w-layout-grid grid-six"><img
                    src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/610073541eccb92ca5961991_greatminds-customers-nhs.svg"
                    loading="lazy" id="w-node-be68976a-f568-b18b-6201-a8cd4b1a3a3a-0862c5d4" alt="NHS" /><img
                    src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/610073548ce1a9bee73ce74e_greatminds-customers-ibm.svg"
                    loading="lazy" id="w-node-ccff1a4c-a973-9d70-5329-bc8c9abd473b-0862c5d4" alt="IBM" /><img
                    src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/610073542f1f09db2e5d36a2_greatminds-customers-fa.svg"
                    loading="lazy" id="w-node-_75d1127e-7554-2546-e7fd-a3c4feb4fd8a-0862c5d4" alt="The FA" /><img
                    src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/6100735402f1de3dcb47bdcf_greatminds-customers-rbs.svg"
                    loading="lazy" id="w-node-b2148419-9a67-2339-9604-6919e6a69fa4-0862c5d4"
                    alt="Lucozade Ribena Suntory" /><img
                    src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/61007354a52a3828a09ee571_greatminds-customers-tw.svg"
                    loading="lazy" id="w-node-_854b4f61-0e8d-0a03-66b2-bc53182b2eca-0862c5d4"
                    alt="Taylor Wimpey" /><img
                    src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/610073547e49d84d86dc78a6_greatminds-customers-fca.svg"
                    loading="lazy" id="w-node-e9d7f38d-5605-ae0c-c48a-198ed578f89c-0862c5d4" alt="FCA" /></div>
        </div>
    </section>
    <section id="Courses" class="relative xxl-gap wf-section">
        <div class="clipped">
            <div style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                class="course-curve-background"></div>
            <div style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                class="course-curve-foreground"></div>
        </div>
        <div class="container w-container">
            <h2>Our range of courses</h2>
            <div class="w-layout-grid grid-three courses">
                <div class="feature-wrapper"><img
                        src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/610117b5dab1afcb5dace3f4_course-illustration-1.svg"
                        loading="lazy" alt="Managing mental health for managers course illustration"
                        class="course-illustration" />
                    <h3>Managing the Mental Health of your Team</h3>
                    <p>This course explores how to manage your mental health in the workplace and provide effective
                        intervention to support your team and colleagues.  It identifies the signs and symptoms of
                        common mental health issues, and uncovers the legal implications an employer has to support
                        its workforce, and how to manage conversations and absences due to mental ill health.</p>
                </div>
                <div class="feature-wrapper"><img
                        src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/610117b5458eea55553b1456_course-illustration-2.svg"
                        loading="lazy" alt="Managing stress during the Covid-19 crisis course illustration"
                        class="course-illustration" />
                    <h3>Lets Talk Race! (New)</h3>
                    <p>This course provides an incredible insight to race, racial diversity and the impact of
                        racism, prejudice and racial bias has in the workplace and society. It identifies the four
                        types of racism and explores the impact this can have on mental health. It covers how to
                        approach and start a conversation around race, and the most appropriate language to use. The
                        session is concluded by providing you with the tools to become a better anti-racism ally.
                    </p>
                </div>
                <div class="feature-wrapper"><img
                        src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/610117b5e74ecc5ae470c3cc_course-illustration-3.svg"
                        loading="lazy" alt="Stress management course illustration" class="course-illustration" />
                    <h3>Stress Management</h3>
                    <p>This workshop explores the harmful long-term effects of stress on our mental and physical
                        health and provides strategies and tools for managing individual stressors more effectively.
                        It defines what stress is, and how it can play out in our personal lives and in the
                        workplace</p>
                </div>
                <div class="feature-wrapper"><img
                        src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/610117b5323d5b6c8f959a9e_course-illustration-4.svg"
                        loading="lazy" alt="Starting and managing the conversation course illustration"
                        class="course-illustration" />
                    <h3>Unconscious Bias Training</h3>
                    <p>This course uncovers what unconscious bias is, and why it occurs. It identifies the many
                        types of bias that can show up at work, including affinity bias and gender bias, and the
                        negative impact this has in the workplace. It provides strategies to address it, and tools
                        to measure the progress.</p>
                </div>
                <div class="feature-wrapper"><img
                        src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/610117b564e81445d889c51c_course-illustration-5.svg"
                        loading="lazy" alt="Mental health awareness course illustration"
                        class="course-illustration" />
                    <h3>Mental Health Awareness</h3>
                    <p>This course introduces the importance of mental health, and identifies the signs and symptoms
                        of mental health issues such as Anxiety, Depression and Psychosis in the workplace. It
                        explores the importance of managing your mental health, and uncovers strategies to help
                        manage it effectively.</p>
                </div>
                <div class="feature-wrapper"><img
                        src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/610117b5ac028a714ee1d543_course-illustration-6.svg"
                        loading="lazy" alt="Emotional intelligence &amp; resilience course illustration"
                        class="course-illustration" />
                    <h3>Emotional Intelligence &amp; Resilience</h3>
                    <p>Our resilience training and provides practical strategies, tactics and tools to improve
                        mental, emotional and physical resilience in leaders, managers and teams. It explores the
                        six characteristics of resilience, and shares the tools needed to help build and maintain
                        high resilience, to help manage stress and increase effectiveness in the workplace</p>
                </div>
            </div>
        </div>
    </section>
    <section id="MHFA" class="xl-gap wf-section">
        <div class="container w-container">
            <h2>Mental Health First Aid Training</h2>
            <div class="w-layout-grid grid-two"><img
                    src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/610130d39366c32014e41b48_mhfa-illustration.svg"
                    loading="lazy" alt="Managing stress during the " />
                <div>
                    <p><strong>Become a Mental Health First Aider in your organisation</strong></p>
                    <p>As an accredited <a href="https://mhfaengland.org/" target="_blank">MHFA England
                            Instructor</a> and trusted Associate (one of the highest ranking with MHFA) Yohan can
                        offer the three official courses that will enable you to spot the triggers and signs of a
                        range of mental health issues, it gives you the confidence to step in, reassure and support
                        a person in distress, and the knowledge to help someone recover their health by guiding them
                        to further support.</p>
                    <ol role="list">
                        <li>MHFA Champion — 1 Day course</li>
                        <li>Mental Health First Aider — 2 Day course</li>
                        <li>MHFA Refresher — 4 Hour course</li>
                    </ol><a
                        href="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/61029c3af1eb604d065a64b9_Mental Health First Aid 1 Day.pdf"
                        target="_blank" class="button gap gap-right w-button">1 Day Course PDF</a><a
                        href="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/61029c3ab2386424823a631a_Mental Health First Aid 2 Day %26 Online.pdf"
                        target="_blank" class="button w-button">2 Day Course PDF</a>
                </div>
            </div>
        </div>
    </section>
    <section class="xl-gap wf-section">
        <div class="container w-container">
            <h2>What our customers think</h2>
            <blockquote>“Yohan delivered one of the best pieces of training I have attended. He helped create an
                environment where we shared some very personal experiences and feel safe in doing it, this was a
                challenging but extremely rewarding experience.”<br /><br />— <span class="cite">Paul Phythian, Head
                    of BPO UKI, IBM</span><span class="cite"></span></blockquote>
        </div>
    </section>
    <section id="Contact" class="l-gap wf-section">
        <div class="container w-container">
            <h2>Send me a message</h2>
            <div class="w-layout-grid grid-two">
                <div class="w-form">
                    <form id="wf-form-Contact-Form" name="wf-form-Contact-Form" data-name="Contact Form"
                        method="get">
                        <div class="w-layout-grid grid-two form">
                            <div><label for="Firstname">First Name</label><input type="text" class="input w-input"
                                    maxlength="256" name="Firstname" data-name="Firstname" placeholder=""
                                    id="Firstname" required="" /></div>
                            <div><label for="Lastname">Last name</label><input type="text" class="input w-input"
                                    maxlength="256" name="Lastname" data-name="Lastname" placeholder=""
                                    id="Lastname" required="" /></div>
                            <div><label for="email">Email Address</label><input type="email" class="input w-input"
                                    maxlength="256" name="email" data-name="Email" placeholder="" id="email"
                                    required="" /></div>
                            <div><label for="Telephone">Telephone</label><input type="tel" class="input w-input"
                                    maxlength="256" name="Telephone" data-name="Telephone" placeholder=""
                                    id="Telephone" required="" /></div>
                        </div><label for="Message">Message</label><textarea data-name="Message" maxlength="5000"
                            id="Message" name="Message" required="" placeholder="Dear Yohan"
                            class="input textarea gap w-input"></textarea><input type="submit"
                            value="Send your message" data-wait="Sending happy thoughts..."
                            class="button w-button" />
                    </form>
                    <div class="success-message w-form-done">
                        <div>Thank you so much. Once I have received your message, I will get back to you within one
                            working day.</div>
                    </div>
                    <div class="w-form-fail">
                        <div>Oops! Something went wrong while submitting the form.</div>
                    </div>
                </div><img
                    src="https://uploads-ssl.webflow.com/60fff0c2ee17fc46c9f078db/610135017eb6bbc2630138f2_contact_form_illustration.svg"
                    loading="lazy" id="w-node-_59b498ce-4754-e2f3-a472-e7af9447acc4-0862c5d4"
                    alt="A woman typing a message on a laptop" />
            </div>
        </div>
    </section> --}}
</main>
@endsection
