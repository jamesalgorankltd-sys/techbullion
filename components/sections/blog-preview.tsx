"use client"

import { useRef, useEffect, useState } from "react"
import Link from "next/link"
import Image from "next/image"
import { ArrowRight, Clock, User, Eye } from "lucide-react"
import { Button } from "@/components/ui/button"

const blogPosts = [
  {
    id: 1,
    title: "The Rise of Artificial General Intelligence: What to Expect in 2026",
    excerpt: "Exploring the breakthroughs bringing us closer to AGI and what it means for humanity's future.",
    category: "AI",
    author: "Ahmad Malik",
    date: "Apr 5, 2026",
    readTime: "8 min read",
    views: "12.5K",
    image: "https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&h=500&fit=crop",
    featured: true,
  },
  {
    id: 2,
    title: "Quantum Computing Reaches New Milestone",
    excerpt: "IBM's latest quantum processor achieves unprecedented qubit coherence times.",
    category: "Quantum",
    author: "Michael Park",
    date: "Apr 4, 2026",
    readTime: "5 min read",
    views: "8.2K",
    image: "https://images.unsplash.com/photo-1635070041078-e363dbe005cb?w=800&h=500&fit=crop",
    featured: false,
  },
  {
    id: 3,
    title: "Web3 Security: Protecting Your Digital Assets",
    excerpt: "Essential strategies for safeguarding your cryptocurrency and NFT investments.",
    category: "Security",
    author: "Emma Wilson",
    date: "Apr 3, 2026",
    readTime: "6 min read",
    views: "15.1K",
    image: "https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=800&h=500&fit=crop",
    featured: false,
  },
  {
    id: 4,
    title: "The Future of Remote Work: AI-Powered Collaboration",
    excerpt: "How artificial intelligence is transforming the way distributed teams work together.",
    category: "Future Tech",
    author: "David Kim",
    date: "Apr 2, 2026",
    readTime: "7 min read",
    views: "9.8K",
    image: "https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=500&fit=crop",
    featured: false,
  },
]

export function BlogPreview() {
  const [isVisible, setIsVisible] = useState(false)
  const sectionRef = useRef<HTMLElement>(null)

  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          setIsVisible(true)
        }
      },
      { threshold: 0.1 }
    )

    if (sectionRef.current) {
      observer.observe(sectionRef.current)
    }

    return () => observer.disconnect()
  }, [])

  const featuredPost = blogPosts.find((post) => post.featured)
  const otherPosts = blogPosts.filter((post) => !post.featured)

  return (
    <section ref={sectionRef} className="relative py-32 bg-[#0a0a0a] overflow-hidden">
      {/* Background Effects */}
      <div className="absolute inset-0 grid-pattern opacity-30" />

      <div className="container mx-auto px-6 relative z-10">
        {/* Section Header */}
        <div className="flex flex-col md:flex-row items-start md:items-end justify-between gap-6 mb-16">
          <div>
            <span className="inline-block text-[#00ff88] text-sm font-semibold tracking-wider uppercase mb-4">
              Latest Articles
            </span>
            <h2 className="text-4xl md:text-5xl font-bold text-white">
              Fresh from the <span className="gradient-text">Blog</span>
            </h2>
          </div>
          <Link href="/blog">
            <Button
              variant="outline"
              className="border-[#333] bg-transparent text-white hover:bg-white/5 hover:border-[#00ff88]/50 group"
            >
              View All Articles
              <ArrowRight className="ml-2 w-4 h-4 transition-transform group-hover:translate-x-1" />
            </Button>
          </Link>
        </div>

        {/* Blog Grid */}
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
          {/* Featured Post */}
          {featuredPost && (
            <Link
              href={`/blog/${featuredPost.id}`}
              className={`group relative rounded-2xl overflow-hidden glass ${
                isVisible ? "animate-slide-up" : "opacity-0"
              }`}
            >
              <div className="aspect-[16/10] relative overflow-hidden">
                <Image
                  src={featuredPost.image}
                  alt={featuredPost.title}
                  fill
                  className="object-cover transition-transform duration-700 group-hover:scale-110"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-[#0a0a0a]/50 to-transparent" />
                
                {/* Category Badge */}
                <div className="absolute top-6 left-6">
                  <span className="px-3 py-1 bg-[#00ff88] text-[#0a0a0a] text-sm font-semibold rounded-full">
                    {featuredPost.category}
                  </span>
                </div>
              </div>

              <div className="p-8">
                <h3 className="text-2xl md:text-3xl font-bold text-white mb-4 group-hover:text-[#00ff88] transition-colors text-balance">
                  {featuredPost.title}
                </h3>
                <p className="text-white/60 mb-6 leading-relaxed">
                  {featuredPost.excerpt}
                </p>
                <div className="flex items-center gap-6 text-sm text-white/50">
                  <span className="flex items-center gap-2">
                    <User className="w-4 h-4" />
                    {featuredPost.author}
                  </span>
                  <span className="flex items-center gap-2">
                    <Clock className="w-4 h-4" />
                    {featuredPost.readTime}
                  </span>
                  <span className="flex items-center gap-2">
                    <Eye className="w-4 h-4" />
                    {featuredPost.views}
                  </span>
                </div>
              </div>
            </Link>
          )}

          {/* Other Posts */}
          <div className="space-y-6">
            {otherPosts.map((post, index) => (
              <Link
                key={post.id}
                href={`/blog/${post.id}`}
                className={`group flex gap-6 p-4 rounded-xl glass transition-all hover:border-[#00ff88]/30 ${
                  isVisible ? "animate-slide-up" : "opacity-0"
                }`}
                style={{ animationDelay: `${(index + 1) * 100}ms` }}
              >
                <div className="relative w-32 h-32 flex-shrink-0 rounded-lg overflow-hidden">
                  <Image
                    src={post.image}
                    alt={post.title}
                    fill
                    className="object-cover transition-transform duration-500 group-hover:scale-110"
                  />
                </div>
                <div className="flex-1 flex flex-col justify-center">
                  <span className="text-[#00ff88] text-xs font-semibold tracking-wider uppercase mb-2">
                    {post.category}
                  </span>
                  <h3 className="text-lg font-bold text-white group-hover:text-[#00ff88] transition-colors mb-2 line-clamp-2">
                    {post.title}
                  </h3>
                  <div className="flex items-center gap-4 text-xs text-white/50">
                    <span>{post.date}</span>
                    <span>{post.readTime}</span>
                  </div>
                </div>
              </Link>
            ))}
          </div>
        </div>
      </div>
    </section>
  )
}
