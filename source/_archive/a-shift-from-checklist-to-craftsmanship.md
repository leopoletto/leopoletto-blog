---
extends: _layouts.post
section: content
title: "A Shift from Checklist to Craftsmanship"
date: 2025-08-18
description: A personal introduction to my Open Lab series. After seven months of sobriety, I look back at the projects I built during this time — from fonts and colors to accessibility, privacy, and web performance — and lay out the roadmap of what I’ll be sharing here.
featured: true
published: true
type: post
image: "about.webp"
cover: "about.webp"
categories: ["open-lab"]
---

There’s one side of me that says writing here again is freedom, and another side that says it’s naivety. Maybe both are true. 

It has been seven months since I wrote my last line of code for Student Crowd, the company where I worked for over a year. As soon as I received the notice that my contract wouldn’t be renewed, I did what I was used to doing, what many developers do: clean the dust off an old blog and start writing again. This time it felt different. I wasn’t just between jobs. I was let go, and though I had been in that position before, this time I was struggling to maintain my mental resilience.

What I didn’t tell anyone is that I’m an addict. I’ve been sober since then — seven months, the longest stretch since I recognized my abuse patterns at 23. Post-pandemic, it hit me harder than ever.

Every company I’ve worked for gave me second, third, and sometimes more chances. They didn’t want to let me go, but I became the shading guy — disappearing slowly. Still delivering tasks, but skipping meetings, fading out of presence. That’s why I never asked for referrals. Not because people disliked me, but because the version of me they saw wasn’t the whole one.

Even though I could deliver, that way of working is selfish and can’t last long.

So, in these months sober, I turned inward and built things. Not for a company, not for deadlines, but for myself — as a way to learn, to stay focused, and to see what I was capable of when I actually showed up.

What I’ve built over the past few months is what I’ll be sharing here. I’m not promising a publishing schedule. I’ll write when I can, but I will publish. For me, this is a way of keeping myself honest. For anyone reading, it’s an invitation to see what I’ve been working on.

---

## A Shift from Checklist to Craftsmanship

When I left Student Crowd, my immediate goal was to get back on my feet. Like many developers, I turned to blogging and sprucing up my professional profile. A key part of that was optimizing my personal site to get the best possible Lighthouse score. I wanted to impress potential employers. What I didn’t expect was a revelation.

I was passing dozens of audits on Lighthouse without a real understanding of what they were or why they were important. I had been treating web standards as a checklist my entire career. I’d fix a failing metric, see the score go up, and move on. This wasn’t a problem unique to me; I realized many developers treat web performance and accessibility as a box to be checked, not a core part of their craft.

I felt like a magician who knew the tricks but didn’t understand the science behind them. This realization was the catalyst for a new project: **Wizard Compass**.

---

## Introducing Wizard Compass

The name "Wizard Compass" came from a simple idea. "Wizard" refers to the familiar, step-by-step process of a CD-ROM installer. "Compass" represents guidance. My goal was to build a tool that wasn't just a Lighthouse wrapper, but an educational companion that would guide developers through each audit, explaining the "why" behind the "what."

I started with a deep dive into the 150+ audits that Lighthouse covers. I read through the documentation, analyzed how DevTools works, and gained a deeper understanding of the intricate relationships between different performance metrics. I worked with **Puppeteer** to automate audits and built a prototype that would explain each step in a clear, digestible way.

But as I delved deeper, I discovered that even Lighthouse, comprehensive as it is, doesn't capture everything that matters. I saw opportunities to add new checks and educational components to help developers build truly robust and privacy-respecting websites.

---

## The Unseen Side of the Web

My exploration into web standards led me down another path: privacy. While building my Lighthouse tool, I became acutely aware of how much data websites collect without our explicit consent. This prompted a side project, a **privacy monitoring Chrome extension**.

My motivation was simple: I wanted to see what was happening behind the scenes. This tool, which I never intended to publish, monitored and displayed a wide range of data points, from a website's cookies to whether it was actively recording my screen and mouse movements. The complexity of getting it approved for a public store was immense, but that was never the point. The point was to learn.

This tool revealed a new layer of complexity to my work. It showed me how much developers are often unaware of the third-party scripts and services they embed, and how those services can violate user privacy. It became clear that privacy is a fundamental web standard that is often overlooked. It's not just a legal requirement but an ethical one.

Wizard Compass, therefore, won't be just about Lighthouse scores. It will be about building a more honest, transparent, and respectful web. It's a journey from treating standards as a checklist to embracing them as a core part of the developer’s craft. And it all started with a simple question: "Why am I passing this audit?"

---

## The Path from Privacy to Transparency

My deep dive into web performance and user journeys with Wizard Compass quickly led to a new concern: privacy and transparency. When I was building the site verification tool for Wizard Compass, I realized that for me to properly audit a user’s website, I needed to identify myself as a bot. This simple act of ethical disclosure made me think about the countless other bots and services that don't play by the rules. I was building a tool to help people be more transparent, but at the same time, I was becoming acutely aware of the lack of transparency across the web.

I couldn’t ignore the issue. So, I started my research journey with the **HTTP Archive**, focusing on how websites define their `robots.txt` files. This file, meant to guide search engine crawlers, is often the first and only statement a website makes about its intentions with automated data collection. The data I pulled was surprising. It revealed a wide range of practices, from well-intentioned to completely misleading.

This research led me to build a `robots.txt` analyzer. Instead of immediately asking users to verify their website ownership, my tool offers a free, instant analysis of their `robots.txt` file. This serves as a transparent opening to the conversation. The user receives a valuable, free report, and in return, I can then say, “To continue this journey and deliver the full value of a complete audit, we need you to verify you own this website.”

This approach not only provides value up front but also serves as an ethical statement. It allows me to explain the "why" behind the verification step: to protect their website from competitors or malicious actors trying to scrape their data. My concern about my own privacy became a project about helping others protect theirs, all while building a more trustworthy and transparent user experience for my own tool.

---

## From Personal Vision to Accessible Color Palettes

My journey with web standards is also a very personal one. As someone with a high level of myopia and astigmatism, I understand firsthand how crucial visual clarity is. Without my glasses, the digital world is a blur. This personal experience is what led me to focus on accessibility, specifically through the lens of color.

I have a habit of saving and documenting anything I find useful, and my collection of bookmarks on topics like color theory and accessibility grew rapidly. I began by working with different color formats, trying to grasp the concepts of converting one to another. My goal was simple: to build a tool for myself that would make working with color both intuitive and technically sound.

I found a baseline of inspiration in tools like **Coolors.co**. I was fascinated by their ability to generate harmonious color palettes. This led me down a rabbit hole of color wheel theory, a topic I am still learning about every day. I started to implement methods to generate colors based on the principles of **harmony, tones, tints, shades, temperatures, and gradients**.

But I didn't want to just mimic what was already out there. I wanted to build something that was truly accessible. This is where my personal experience with visual impairment came into play. I realized that if the input color was too dark, or if a user requested a large number of colors, the generated palette might contain colors that were imperceptibly close to one another. For someone with a vision impairment, this could render the palette useless.

To solve this, I implemented a **safe step-sizing** algorithm. The number of colors returned by my tool is anchored to a minimum **Delta E 2000** difference of at least 11. Delta E is a metric that measures the difference between two colors as perceived by the human eye. By enforcing a minimum difference of 11, I could ensure that every single color in a generated palette was perceptibly distinct.

This was a significant technical challenge because each color variation—tints, shades, hues—requires a different approach to calculate the step size. Tints and shades, for example, involve changes in brightness, while hues involve changes on the color wheel. My solution was to build a dynamic step-sizing system that would apply the correct logic for each variation, ensuring that the final output was always perceptually meaningful and, most importantly, accessible.

What began as a personal fascination with color became a mission to build a tool that helps developers and designers create color palettes that are not only beautiful but also truly usable for everyone.

---

## Ensuring Readability: The Contrast Validator and Fixer

My commitment to accessibility went beyond just generating beautiful and perceptually distinct colors. It extended to ensuring those colors were truly readable for everyone. Following the **WCAG (Web Content Accessibility Guidelines)**, I implemented a contrast validator into my tool. This was a critical step in making the color palettes I generated not just harmonious but also compliant with industry standards.

But a simple validator wasn't enough. I wanted to build a tool that didn't just tell you there was a problem; I wanted it to offer a solution. This led to the creation of my contrast "fixer" tool. It works by identifying whether the foreground or background color needs adjustment. The logic is simple yet powerful: it determines whether white or black is closer to a passing contrast ratio, and then it begins to lighten or darken the color in small steps. It loops, calling the checker after each change, until the necessary ratio is achieved. This provides the user with an exact color value they can use to fix the issue immediately.

I also recognized that changing colors isn't the only solution. Sometimes, a simple change to the typography is all that's needed. So, I added a feature that allows users to adjust the **text properties**, specifically **increasing the font size or adding boldness**. My tool provides recommendations for these changes and calculates how they would affect the overall contrast ratio. This holistic approach empowers developers to solve contrast issues in multiple ways, offering a deeper understanding of the interplay between color and typography.

---

## Challenging the Status Quo: Why All Fonts Are Not Created Equal

My deep dive into color contrast led me to a fundamental question: **How can the same contrast formula apply equally to two completely different fonts like Cabin and JetBrains Mono?** This question became the anchor for my foray into font metrics. I realized that the visual weight, x-height, and general shape of a typeface significantly impact its readability, yet these nuances are not considered by the standard contrast formula. I was determined to prove that a more sophisticated approach was needed.

I began my research by creating a rudimentary **bash script** that used `fonttools` and `jq` to parse font data from the entire Google Fonts catalog. My script looped through the API, downloading each font file one by one to extract its unique metrics. I wanted to demonstrate the potential for a new, more intelligent contrast formula that would account for these subtle differences. I specifically targeted **Inter**, a popular modern typeface, and normalized its metrics to match other fonts, like Roboto.

This project grew into a more sophisticated idea: not just to analyze, but to fix. I realized that a one-size-fits-all approach to font rendering and fallbacks was inefficient. I discovered and was inspired by tools like **Capsize**, which works to create consistent font sizing and spacing regardless of the typeface used. I wanted to take this a step further by creating platform-specific fallbacks to ensure consistency across different operating systems.

This work is now at the heart of a project I've been building, with a clear vision and even a registered domain: **fontlint.com**. My goal is to create a tool that moves beyond the basic contrast check and provides a granular, data-driven approach to typography. It’s about building a better web, one font at a time.

---

## Simulating and validating color vision deficiencies

On the accessibility topic, you've developed a sophisticated approach to simulating and validating color vision deficiencies (CVDs). Your methodology, inspired by **DaltonLens**, combines scientific simulation with a quantitative analysis using **Delta E 2000** to determine the perceptual difference between colors. This is a robust approach that goes beyond simple pass/fail checks.

Your process for validating color palettes involves creating a matrix to check if colors, once transformed for a specific CVD, remain perceptually distinct. This is a smart application of Delta E 2000, as it ensures that your palette is not only beautiful but also functional for people with color blindness.

For images, you extended this method by comparing pixel differences before and after CVD simulation. The thresholds you established—**Safe/Accessible**, **Deceptive Perception**, **Contextual Camouflage**, and **Blocked Vision**—are a brilliant way to quantify the impact of a visual impairment on image comprehension. This gives you a clear metric for how much information is being lost.

The use of CSS `mix-blend-mode: exclusion` is a creative way to visualize the color data that a person with CVD is "losing." The "psychedelic" result you mentioned highlights the stark contrast between what an unimpaired person sees and what a person with a color vision deficiency perceives. It is a powerful, visual representation of the problem you are solving.
