---
extends: _layouts.post
section: content
title: "Open Lab: A Shift from Checklist to Craftsmanship"
date: 2025-08-18
description: A personal introduction to my Open Lab series. After seven months of sobriety, I reflect on the projects I built during this time — from fonts and colors to accessibility, privacy, and performance — and explain how my mindset shifted from checking boxes to building with craftsmanship.
featured: true
published: true
type: post
image: "about.webp"
categories: ["open-lab"]
---

There’s one side of me that says writing here again is freedom, and another side that says it’s dumbness. Maybe both are true.

It has been seven months since I wrote my last line of code for Student Crowd, the company where I worked for over a year. As soon as I received the notice that my contract wouldn’t be renewed, I did what I was used to doing — what many developers do: clean the dust off an old blog and start writing again. This time it felt different. I wasn’t just between jobs. I was let go, and though I had been in that position before, this time I was struggling to maintain my mental resilience.

What I didn’t tell anyone is that I’m an addict. I’ve been sober since then — seven months, the longest stretch since I recognized my abuse patterns at 23. Post-pandemic, it hit me harder than ever.

Every company I’ve worked for gave me second, third, and sometimes more chances. They didn’t want to let me go, but I became the shading guy — disappearing slowly. Still delivering tasks, but skipping meetings, fading out of presence. That’s why I never asked for referrals. Not because people disliked me, but because the version of me they saw wasn’t the whole one.

Even though I could deliver, that way of working is selfish and can’t last long.

So, in these months sober, I turned inward and built things. Not for a company, not for deadlines, but for myself — as a way to learn, to stay focused, and to see what I was capable of when I actually showed up.

What I’ve built over the past few months is what I’ll be sharing here. I’m not promising a publishing schedule. I’ll write when I can, but I will publish. For me, this is a way of keeping myself honest. For anyone reading, it’s an invitation to see what I’ve been working on.

---

## From Checklists to Craft

When I first started optimizing my site, I chased Lighthouse scores like everyone else. Pass the audits, hit 100, move on. But I realized I was treating standards like a checklist, not as part of the craft.

That’s when I started **Wizard Compass** — not just another Lighthouse wrapper, but a tool to explain _why_ each audit matters.

I have mapped the curriculum to match Lighthouse category groups:

### Performance

- Metrics (core scoring metrics)
- Diagnostics (fix opportunities)
- Hidden (supporting “insights”)
  
### Accessibility (A11y)

- Navigation
- ARIA
- Color & Contrast
- Tables & Lists
- Language
- Best Practices
- A11y (Ungrouped audits)
  
### Best Practices

- UX
- JavaScript Libraries
  
### SEO

- Crawl


If you want to receive updates on the course development access [wizardcompass.com](https://wizardcompass.com/), subscribe to the early access list.

---

## Privacy in the Browser

While digging into audits, I noticed how invisible privacy issues are. So I built a **Chrome extension** that shows what sites are collecting and doing in the background.

I never published it, but it taught me how much is hidden — and how easily developers embed third-party scripts without realizing the trade-offs.

The trickier part was mapping players, so I've leveraged [Wappalyzer](https://github.com/HTTPArchive/wappalyzer) data from their last open source version, which HTTP Archive uses to enrich its dataset.

I will write an article about it in detail and open-source the project soon. 

---

## Fonts and Readability

Color contrast checks got me wondering: why do formulas ignore the font itself? JetBrains Mono and Cabin are not the same.

So I started parsing Google Fonts with `fonttools` and `jq`, looking at metrics, x-height, and spacing. That became the seed for **Font Lint**.

You can take a look at [fontlint.com](https://fontlint.com) and subscribe to be the first to test new font optimization tools and have access to datasets.

---

## Colors and Accessibility

I love playing with colors, but I wanted palettes that were not only harmonious, but also accessible. I experimented with **Delta E 2000** to ensure that the generated colors were perceptually distinct.

Then I added a **contrast fixer**: it suggests tweaks to color, font size, or weight until the text meets WCAG accessibility standards.

![Contrast Matrix Built by Leonardo Poletto](/assets/images/posts/contrast-matrix.webp)

---

## Seeing Differently

Accessibility isn’t abstract for me — I have high myopia and astigmatism. That’s what led me to simulate **color vision deficiencies (CVDs)**.

I built transformations that show how colors and images look under different impairments, then validated whether the differences were still perceptible.

![Contrast Matrix Built by Leonardo Poletto](/assets/images/posts/cvd-matrix-before.webp)

> Ratings are calculated by first converting the colors to their simulated counterparts. The simulated values approximate the colors that would be seen by the fully deficient vision of each particular type. The simulated colors are then compared using the `DeltaE 2000` color difference formula. A color difference value of `11` or **more** is **considered passing**; anything lower is too similar to distinguish.<br><br>
> The color difference meters visualize the `DeltaE` value to indicate how different the colors would appear for each color vision deficiency.<br>
> <br><small>Source: [https://leonardocolor.io/tools.html](https://leonardocolor.io/tools.html)</small>


![Contrast Matrix Built by Leonardo Poletto](/assets/images/posts/cvd-matrix-after.webp)

I've explored images, which I will also write about. This is an unseen world by most people, and I intend to share my discoveries.  

---

## Next Steps

This is just the beginning of Open Lab. Each post will unpack one of these projects, with more code, demos, and lessons. I’m not chasing a schedule — I’ll publish as I can. But I will publish.

