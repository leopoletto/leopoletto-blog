import puppeteer from "puppeteer";
import path from "path";
import * as child_process from "node:child_process";
import * as fs from "node:fs";

const args = process.argv.slice(2);

const isProduction = args[0] ?? null;
const postTitle = args[1] ?? null;
const slug = args[2] ?? null;
const fontSize = args[3] ?? null;

(async () => {
    if (postTitle === null || slug === null) {
        console.log("No post title or slug provided!");
        return;
    }

    const setup = isProduction ? {} : {
        headless: 'new',
        executablePath: '/usr/bin/google-chrome', // ✅ Force system Chrome
        args: [
            '--no-sandbox',
            '--disable-setuid-sandbox',
            '--disable-gpu',
            '--disable-software-rasterizer',
            '--disable-dev-shm-usage',
            '--disable-extensions',
        ],
    };

    const browser = await puppeteer.launch(setup);

    const page = await browser.newPage();

    await page.setViewport({width: 1230, height: 600, deviceScaleFactor: 1.0, hasTouch: false})

    const filePath = path.resolve('./', 'opengraph/template.html');
    const fileUrl = `file://${filePath}`;
    await page.goto(fileUrl);

    await page.$eval('#title', (element, postTitle, fontSize) => {
        element.innerText = postTitle

        if (fontSize !== null) {
            element.style.fontSize = `${fontSize}px`;
            element.style.lightHeight = fontSize > 100 ? 0 : '100%';
        }
    }, postTitle, fontSize);

    const screenshotPath = path.join('./', '../source/assets/images/og/', `${slug}.png`);
    await page.screenshot({path: screenshotPath, fullPage: true});

    try {
        await child_process.execSync(`pngquant --output=${screenshotPath} --quality=40-60 --speed=7 --force --strip "${screenshotPath}"`);
        const optimizedImagePath = screenshotPath.replace('.png', '.webp');
        await child_process.execSync(`cwebp -q 90 "${screenshotPath}" -o "${optimizedImagePath}"`)

        fs.unlinkSync(screenshotPath);
    } catch (e) {

    }

    await browser.close();
})(isProduction, postTitle, slug, fontSize);






