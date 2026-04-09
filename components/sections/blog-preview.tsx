import Link from "next/link"
import Image from "next/image"
import { getAllPosts } from "@/lib/posts"

export function BlogPreview() {
  const posts = getAllPosts().slice(0, 3)

  return (
    <section className="py-24">
      <div className="container mx-auto px-6">
        <div className="flex items-end justify-between mb-12">
          <div>
            <p className="text-[#00ff88] uppercase tracking-[0.2em] text-sm mb-3">
              Latest Articles
            </p>
            <h2 className="text-4xl md:text-5xl font-bold text-white">
              Explore Our Latest Blog Posts
            </h2>
          </div>

          <Link
            href="/blog"
            className="hidden md:inline-block text-[#00ff88] font-semibold"
          >
            View All →
          </Link>
        </div>

        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          {posts.map((post) => (
            <article
              key={post.slug}
              className="rounded-2xl overflow-hidden border border-white/10 bg-white/5"
            >
              <div className="relative h-56 w-full">
                <Image
                  src={post.image}
                  alt={post.title}
                  fill
                  className="object-cover"
                />
              </div>

              <div className="p-6">
                <div className="flex items-center gap-3 text-sm text-white/60 mb-3">
                  <span className="text-[#00ff88]">{post.category}</span>
                  <span>•</span>
                  <span>{post.date}</span>
                </div>

                <h3 className="text-2xl font-bold text-white mb-3 leading-tight">
                  <Link href={`/blog/${post.slug}`} className="hover:text-[#00ff88] transition-colors">
                    {post.title}
                  </Link>
                </h3>

                <p className="text-white/70 mb-5">{post.excerpt}</p>

                <div className="flex items-center justify-between text-sm text-white/60">
                  <span>{post.author}</span>
                  <span>{post.readTime}</span>
                </div>
              </div>
            </article>
          ))}
        </div>
      </div>
    </section>
  )
}
