import { notFound } from "next/navigation"
import Image from "next/image"
import { getAllPosts, getPostBySlug } from "@/lib/posts"

type PageProps = {
  params: {
    slug: string
  }
}

export async function generateStaticParams() {
  const posts = getAllPosts()

  return posts.map((post) => ({
    slug: post.slug,
  }))
}

export async function generateMetadata({ params }: PageProps) {
  const post = getPostBySlug(params.slug)

  if (!post) {
    return {
      title: "Post Not Found | TechBullion",
    }
  }

  return {
    title: `${post.title} | TechBullion`,
    description: post.excerpt,
  }
}

export default function SinglePostPage({ params }: PageProps) {
  const post = getPostBySlug(params.slug)

  if (!post) {
    notFound()
  }

  const paragraphs = post.content
    .trim()
    .split("\n")
    .filter(Boolean)

  return (
    <main className="min-h-screen bg-black text-white pt-32 pb-20">
      <div className="container mx-auto px-6">
        <article className="max-w-4xl mx-auto">
          <p className="text-[#00ff88] uppercase tracking-[0.2em] text-sm mb-4">
            {post.category}
          </p>

          <h1 className="text-4xl md:text-6xl font-bold leading-tight mb-6">
            {post.title}
          </h1>

          <p className="text-white/70 text-xl leading-9 mb-8">
            {post.excerpt}
          </p>

          <div className="flex flex-wrap items-center gap-6 text-white/60 text-sm mb-10">
            <span>{post.author}</span>
            <span>{post.date}</span>
            <span>{post.readTime}</span>
            <span>{post.views} views</span>
          </div>

          <div className="relative w-full h-[300px] md:h-[500px] rounded-3xl overflow-hidden border border-white/10 mb-12">
            <Image
              src={post.image}
              alt={post.title}
              fill
              className="object-cover"
            />
          </div>

          <div className="prose prose-invert prose-lg max-w-none">
            {paragraphs.map((line, index) => {
              if (line.startsWith("## ")) {
                return (
                  <h2 key={index} className="text-3xl font-bold mt-10 mb-4 text-white">
                    {line.replace("## ", "")}
                  </h2>
                )
              }

              if (line.startsWith("- ")) {
                return (
                  <li key={index} className="text-white/80 leading-8 ml-5">
                    {line.replace("- ", "")}
                  </li>
                )
              }

              return (
                <p key={index} className="text-white/80 leading-8 mb-6">
                  {line}
                </p>
              )
            })}
          </div>
        </article>
      </div>
    </main>
  )
}
