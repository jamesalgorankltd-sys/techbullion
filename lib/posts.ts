export type BlogPost = {
  title: string
  slug: string
  excerpt: string
  content: string
  author: string
  date: string
  readTime: string
  views: string
  image: string
  category: string
}

export const posts: BlogPost[] = [
  {
    title: "The Rise of Artificial General Intelligence: What to Expect in 2026",
    slug: "rise-of-artificial-general-intelligence-2026",
    excerpt:
      "Exploring the breakthroughs bringing us closer to AGI and what it means for humanity's future.",
    content: `
Artificial General Intelligence is one of the most discussed topics in modern technology.

AGI refers to systems that can understand, learn, and apply intelligence across a wide range of tasks in a human-like way. Unlike narrow AI, which focuses on a single task, AGI aims to perform well across many domains.

## Why AGI Matters

AGI could reshape industries, education, healthcare, research, and productivity. It may help solve problems faster, assist in creative work, and improve decision-making systems.

## Key Areas to Watch

- More powerful multimodal models
- Better memory and reasoning systems
- Safer AI alignment methods
- More human-like agents for daily work

## Challenges Ahead

Even with rapid progress, AGI still faces important challenges:
- Safety and alignment
- Bias and misuse
- Regulation
- High infrastructure costs

## Final Thoughts

The path to AGI is moving fast, but careful development matters. The coming years will likely bring major breakthroughs that redefine how people interact with machines.
    `,
    author: "TechBullion Team",
    date: "April 9, 2026",
    readTime: "8 min read",
    views: "12.5K",
    image: "/blog/ai-future.jpg",
    category: "AI",
  },
  {
    title: "Top Technology Trends That Will Shape the Future of Digital Business",
    slug: "top-technology-trends-digital-business",
    excerpt:
      "A look at the most important innovations influencing companies, startups, and digital growth.",
    content: `
Technology trends continue to shape how digital businesses grow and compete.

## AI Automation

AI automation is helping businesses streamline customer service, marketing, and content workflows.

## Cloud Infrastructure

Modern cloud systems make it easier to scale products quickly and securely.

## Cybersecurity Focus

As businesses become more digital, security becomes more important than ever.

## Final Thoughts

Companies that adapt early to these trends often gain a strong competitive advantage.
    `,
    author: "TechBullion Team",
    date: "April 8, 2026",
    readTime: "6 min read",
    views: "8.2K",
    image: "/blog/tech-trends.jpg",
    category: "Technology",
  },
  {
    title: "How Modern Startups Are Using AI to Build Faster and Scale Smarter",
    slug: "how-startups-use-ai-to-scale",
    excerpt:
      "Startups are adopting AI tools to improve speed, lower costs, and build better products.",
    content: `
Startups are using AI to move faster than ever before.

## Faster Product Development

Teams now use AI for prototyping, coding support, documentation, and customer feedback analysis.

## Smarter Marketing

AI helps startups improve ad targeting, email writing, and social content creation.

## Better Decision-Making

With the right data tools, founders can make faster and more informed business decisions.

## Final Thoughts

AI is becoming a core growth layer for startups that want to scale efficiently.
    `,
    author: "TechBullion Team",
    date: "April 7, 2026",
    readTime: "5 min read",
    views: "6.7K",
    image: "/blog/startup-ai.jpg",
    category: "Startups",
  },
]

export function getAllPosts() {
  return posts
}

export function getPostBySlug(slug: string) {
  return posts.find((post) => post.slug === slug)
}
