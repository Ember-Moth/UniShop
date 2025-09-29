<?php
/**
 * @OA\Tag(
 *     name="UserAgent",
 *     description=""
 * )
 *
 * @OA\Get(
 *      path="/api/v1/agent/config",
 *      summary="获取代理商配置",
 *      tags={"用户代理商"},
 *      @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(
 *               @OA\Property(property="code", type="integer", description="状态码"),
 *               @OA\Property(property="message", type="string", description="消息"),
 *               @OA\Property(property="data", type="object",
 *                   @OA\Property(property="agent_id", type="integer", description="代理商ID"),
 *                   @OA\Property(property="secret_key", type="string", description="代理商secret_key"),
 *                   @OA\Property(property="api_url", type="string", description="API接口URL")
 *               )
 *          )
 *      )
 *  )
 */