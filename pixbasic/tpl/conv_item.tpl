{{if $item.comment_firstcollapsed && ! $item.mod_display}}
<div class="hide-comments-outer fakelink" onclick="collapseComments({{$item.parent}});">
	<span id="hide-comments-{{$item.parent}}" class="hide-comments">{{$item.hide_text}}</span>&nbsp;<span id="hide-comments-total-{{$item.parent}}" class="hide-comments-total">{{$item.num_comments}}</span>
</div>
{{/if}}
	<div id="thread-wrapper-{{$item.id}}" class="thread-wrapper{{if $item.toplevel}} {{$item.toplevel}} generic-content-wrapper h-entry {{else}} u-comment h-cite {{/if}} item_{{$item.submid}}">
		{{if $item.authors}}<span id="thread-authors-{{$item.id}}" style="display: none;">{{foreach $item.authors as $a}}@&#123;{{$a}}&#125; {{/foreach}}</span>{{/if}}
		<a name="item_{{$item.id}}" ></a>
		{{if $item.collapsed}}
		<div id="collapsed-comments-{{$item.id}}" class="collapsed-comments-{{$item.parent}}" style="display: {{if $item.mod_display}}block{{else}}none{{/if}};">
		{{/if}}
		<div class="wall-item-outside-wrapper{{if $item.is_comment}} comment{{/if}}{{if $item.previewing}} preview{{/if}}" id="wall-item-outside-wrapper-{{$item.id}}" >
			<div class="clearfix wall-item-content-wrapper{{if $item.is_comment}} comment{{/if}}" id="wall-item-content-wrapper-{{$item.id}}">
				{{if $item.thread_level > 1}}<hr class="thread-separator">{{/if}}
				{{for $x=3 to $item.thread_level}}<i class="fa fa-caret-right threadlevel {{if $x is odd}}odd{{else}}even{{/if}}"></i>{{/for}}
				{{if $item.indentpx}}
				<div {{if $item.thread_level > 2}}style="margin-left: {{$item.thread_level * $item.indentpx}}px;"{{/if}}>
				{{/if}}
				{{if $item.event}}
				<div class="wall-event-item" id="wall-event-item-{{$item.id}}">
					{{$item.event}}
				</div>
				{{/if}}
				{{if $item.title && !$item.event}}
				<div class="p-2{{if $item.is_new}} bg-primary text-white{{/if}} wall-item-title h3{{if !$item.photo}} rounded-top{{/if}}" id="wall-item-title-{{$item.id}}">
					{{if $item.title_tosource}}{{if $item.plink}}<a href="{{$item.plink.href}}" title="{{$item.title}} ({{$item.plink.title}})" rel="nofollow noopener">{{/if}}{{/if}}{{$item.title}}{{if $item.title_tosource}}{{if $item.plink}}</a>{{/if}}{{/if}}
				</div>
				{{if ! $item.is_new}}
				<hr class="m-0">
				{{/if}}
				{{/if}}
				<div class="p-2 clearfix wall-item-head{{if $item.is_new && !$item.title && !$item.event && !$item.is_comment}} wall-item-head-new rounded-top{{/if}}">
					{{if $item.pinned}}
						<span class="float-right wall-item-pinned" title="{{$item.pinned}}" id="wall-item-pinned-{{$item.id}}"><i class="fa fa-thumb-tack">&nbsp;</i></span>
					{{/if}}
					{{if $item.isdraft}}
						<span class="float-right wall-item-draft" title="{{$item.draft_txt}}" id="wall-item-draft-{{$item.id}}"><a href="editpost/{{$item.id}}"><i class="fa fa-floppy-o">&nbsp;</i></a></span>
					{{/if}}

					<div class="wall-item-info " id="wall-item-info-{{$item.id}}" >
						<div class="wall-item-photo-wrapper{{if $item.owner_url}} wwfrom{{/if}} h-card p-author" id="wall-item-photo-wrapper-{{$item.id}}">
							<img src="{{$item.thumb}}" class="fakelink wall-item-photo{{$item.sparkle}} u-photo p-name" id="wall-item-photo-{{$item.id}}" alt="{{$item.name}}" data-toggle="dropdown" />
							{{if $item.thread_author_menu}}
							<i class="fa fa-caret-down wall-item-photo-caret cursor-pointer" data-toggle="dropdown"></i>
							<div class="dropdown-menu">
								{{foreach $item.thread_author_menu as $mitem}}
								<a class="dropdown-item" {{if $mitem.href}}href="{{$mitem.href}}"{{/if}} {{if $mitem.action}}onclick="{{$mitem.action}}"{{/if}} {{if $mitem.title}}title="{{$mitem.title}}"{{/if}} >{{$mitem.title}}</a>
								{{/foreach}}

							</div>
							{{/if}}
						</div>
					</div>
					<div class="wall-item-author">
						{{if $item.previewing}}<span class="preview-indicator"><i class="fa fa-eye" title="{{$item.preview_lbl}}"></i></span>&nbsp;{{/if}}
						<a href="{{$item.profile_url}}" title="{{$item.linktitle}}" class="wall-item-name-link u-url"><span class="wall-item-name{{$item.sparkle}}" id="wall-item-name-{{$item.id}}" >{{$item.name}}</span></a>{{if $item.owner_url}}&nbsp;{{$item.via}}&nbsp;<a href="{{$item.owner_url}}" title="{{$item.olinktitle}}" class="wall-item-name-link"><span class="wall-item-name{{$item.osparkle}}" id="wall-item-ownername-{{$item.id}}">{{$item.owner_name}}</span></a>{{/if}}
					</div>

					{{* We'll be needing some space between author's name and post head items *}} 
					<div id="wall-item-spacer" class="wall-item-spacer"></div>

						{{foreach $item.responses as $verb=>$response}}
						{{if $response.count}}
						<div class="wall-item-likedislike">
							<button type="button" title="{{$response.button}}" class="clean-btn wall-item-like"{{if $response.modal}} data-toggle="modal" data-target="#{{$verb}}Modal-{{$item.id}}"{{else}} data-toggle="dropdown"{{/if}} id="wall-item-{{$verb}}-{{$item.id}}">{{if $verb=='like'}}<i class="fa fa-fw fa-heart"></i>{{else}}<i class="fa fa-fw fa-thumbs-down"></i>{{/if}}</button>
                        <div class="response-count">{{$item.responses.{{$verb}}.count}}</div>
							{{if $response.modal}}
							<div class="modal" id="{{$verb}}Modal-{{$item.id}}">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">{{$response.button}}</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										</div>
										<div class="modal-body response-list">
											<ul class="nav nav-pills flex-column">{{foreach $response.list as $liker}}<li class="nav-item">{{$liker}}</li>{{/foreach}}</ul>
										</div>
										<div class="modal-footer clear">
											<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">{{$item.modal_dismiss}}</button>
										</div>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
							{{else}}
							<div class="dropdown-menu">{{foreach $response.list as $liker}}{{$liker}}{{/foreach}}</div>
							{{/if}}
						</div>
						{{/if}}
						{{/foreach}}


							<div class="wall-item-icon">
								<button type="button" class="clean-btn" data-toggle="dropdown" id="wall-item-menu-{{$item.id}}">
									<i class="fa fa-fw fa-ellipsis-v"></i>
								</button>
								<div class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="wall-item-menu-{{$item.id}}">
									{{if $item.embed}}
									<a class="dropdown-item" href="#" onclick="jotEmbed({{$item.id}},{{$item.item_type}}); return false"><i class="generic-icons-nav fa fa-fw fa-share" title="{{$item.embed}}"></i>{{$item.embed}}</a>
									{{/if}}
									{{if $item.plink}}
									<a class="dropdown-item" href="{{$item.plink.href}}" title="{{$item.plink.title}}" class="u-url"><i class="generic-icons-nav fa fa-fw fa-external-link"></i>{{$item.plink.title}}</a>
									{{/if}}
									{{if $item.edpost}}
									<a class="dropdown-item" href="{{$item.edpost.0}}" title="{{$item.edpost.1}}"><i class="generic-icons-nav fa fa-fw fa-pencil"></i>{{$item.edpost.1}}</a>
									{{/if}}
									{{if $item.tagger}}
									<a class="dropdown-item" href="#"  onclick="itemTag({{$item.id}}); return false;"><i id="tagger-{{$item.id}}" class="generic-icons-nav fa fa-fw fa-tag" title="{{$item.tagger.tagit}}"></i>{{$item.tagger.tagit}}</a>
									{{/if}}
									{{if $item.filer}}
									<a class="dropdown-item" href="#" onclick="itemFiler({{$item.id}}); return false;"><i id="filer-{{$item.id}}" class="generic-icons-nav fa fa-fw fa-folder-open" title="{{$item.filer}}"></i>{{$item.filer}}</a>
									{{/if}}
									{{if $item.pinnable}}
									<a class="dropdown-item dropdown-item-pinnable" href="#" onclick="dopin({{$item.id}}); return false;" title="{{$item.pinme}}" id="item-pinnable-{{$item.id}}"><i class="generic-icons-nav fa fa-fw fa-thumb-tack"></i>{{$item.pinme}}</a>
									{{/if}}									
									{{if $item.bookmark}}
									<a class="dropdown-item" href="#" onclick="itemBookmark({{$item.id}}); return false;"><i id="bookmarker-{{$item.id}}" class="generic-icons-nav fa fa-fw fa-bookmark" title="{{$item.bookmark}}"></i>{{$item.bookmark}}</a>
									{{/if}}
									{{if $item.addtocal}}
									<a class="dropdown-item" href="#" onclick="itemAddToCal({{$item.id}}); return false;"><i id="addtocal-{{$item.id}}" class="generic-icons-nav fa fa-fw fa-calendar" title="{{$item.addtocal}}"></i>{{$item.addtocal}}</a>
									{{/if}}
									{{if $item.star}}
									<a class="dropdown-item" href="#" onclick="dostar({{$item.id}}); return false;"><i id="starred-{{$item.id}}" class="generic-icons-nav fa fa-fw{{if $item.star.isstarred}} starred fa-star{{else}} unstarred fa-star-o{{/if}}" title="{{$item.star.toggle}}"></i>{{$item.star.toggle}}</a>
									{{/if}}
									{{if $item.thread_action_menu}}
									{{foreach $item.thread_action_menu as $mitem}}
									<a class="dropdown-item" {{if $mitem.href}}href="{{$mitem.href}}"{{/if}} {{if $mitem.action}}onclick="{{$mitem.action}}"{{/if}} {{if $mitem.title}}title="{{$mitem.title}}"{{/if}} ><i class="generic-icons-nav fa fa-fw fa-{{$mitem.icon}}"></i>{{$mitem.title}}</a>
									{{/foreach}}
									{{/if}}
									{{if $item.drop.dropping}}
									<a class="dropdown-item" href="#" onclick="dropItem('item/drop/{{$item.id}}', '#thread-wrapper-{{$item.id}}'); return false;" title="{{$item.drop.delete}}" ><i class="generic-icons-nav fa fa-fw fa-trash-o"></i>{{$item.drop.delete}}</a>
									{{/if}}
									{{if $item.dropdown_extras}}
									<div class="dropdown-divider"></div>
																		{{$item.dropdown_extras}}
									{{/if}}
									{{if $item.edpost && $item.dreport}}
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="dreport/{{$item.dreport_link}}">{{$item.dreport}}</a>
									{{/if}}
								</div>
							</div>
							{{if $item.attachments}}
							<div class="wall-item-attachments">
								<button type="button" class="clean-btn" data-toggle="dropdown" id="attachment-menu-{{$item.id}}"><i class="fa fa-fw fa-paperclip"></i></button>
								<div class="dropdown-menu">{{$item.attachments}}</div>
							</div>
							{{/if}}
					{{if $item.lock}}
					<div class="wall-item-lock dropdown clean-btn">
						<i class="clean-btn fa fa-fw {{if $item.locktype == 2}}fa-envelope{{else}}fa-lock{{/if}} lockview{{if $item.privacy_warning}} text-warning{{/if}}" data-toggle="dropdown" title="{{$item.lock}}" onclick="lockview('item',{{$item.id}});" ></i>
						<div id="panel-{{$item.id}}" class="dropdown-menu"></div>
					</div>
					{{/if}}
				</div>
				{{if $item.photo}}
				<div class="wall-photo-item" id="wall-photo-item-{{$item.id}}">
					{{$item.photo}}
				</div>
				<div class="wall-item-ago"  id="wall-item-ago-{{$item.id}}">
					{{if $item.location}}<span class="wall-item-location p-location" id="wall-item-location-{{$item.id}}">{{$item.location}},<br />;</span>{{/if}}<span class="autotime" title="{{$item.isotime}}"><time class="dt-published" datetime="{{$item.isotime}}">{{$item.localtime}}</time>{{if $item.editedtime}}&nbsp;{{$item.editedtime}}{{/if}}{{if $item.expiretime}}&nbsp;{{$item.expiretime}}{{/if}}</span>{{if $item.editedtime}}&nbsp;<i class="fa fa-pencil"></i>{{/if}}&nbsp;{{if $item.delayed}}<i class="fa fa-clock-o"></i>&nbsp;{{/if}}{{if $item.app}}<span class="item.app">{{$item.str_app}}</span>{{/if}}
				</div>
				{{/if}}
				{{if $item.divider}}
				<hr class="wall-item-divider">
				{{/if}}
				{{if !$item.photo && $item.body}}
				<div class="p-2 wall-item-content clearfix" id="wall-item-content-{{$item.id}}">
					<div class="wall-item-body e-content" id="wall-item-body-{{$item.id}}" >
						{{$item.body}}
						{{* $item.comment_order *}}
					</div>
				</div>
				{{/if}}
				{{if $item.has_tags}}
				<div class="p-2 wall-item-tools clearfix">
					<div class="body-tags">
						<span class="tag">{{$item.mentions}} {{$item.tags}} {{$item.categories}} {{$item.folders}}</span>
					</div>
				</div>
				{{/if}}

				<div class="p-2 clearfix wall-item-tools">
					<div class="float-left wall-item-tools-left">
						<div class="btn-group">
							<div id="like-rotator-{{$item.id}}" class="spinner-wrapper">
								<div class="spinner s"></div>
							</div>
						</div>
						{{if $item.toplevel && $item.emojis && $item.reactions}}
						<div class="btn-group">
							<button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-toggle="dropdown" id="wall-item-react-{{$item.id}}">
								<i class="fa fa-fw fa-smile-o"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-right">
							{{foreach $item.reactions as $react}}
								<a class="dropdown-item clearfix" href="#" onclick="jotReact({{$item.id}},'{{$react}}'); return false;"><img class="menu-img-2" src="/images/emoji/{{$react}}.png" alt="{{$react}}" /></a>
							{{/foreach}}
							</div>
						</div>
						{{/if}}
						<div class="btn-group">
							{{if $item.like}}
							<button type="button" title="{{if $item.my_responses.like}}{{$item.like.1}}{{else}}{{$item.like.0}}{{/if}}" class="clean-btn like" onclick="dolike({{$item.id}},{{if $item.my_responses.like}} 'Undo/' + {{/if}} 'Like' ); return false;">
								<i class="fa fa-fw {{if !$item.my_responses.like}}fa-heart-o{{else}}fa-heart ivoted{{/if}}" ></i>
							</button>
							{{/if}}
							{{if $item.dislike}}
							<button type="button" title="{{if $item.my_responses.dislike}}{{$item.dislike.1}}{{else}}{{$item.dislike.0}}{{/if}}" class="clean-btn dislike" onclick="dolike({{$item.id}},{{if $item.my_responses.dislike}} 'Undo/' + {{/if}} 'Dislike'); return false;">
								<i class="fa fa-fw {{if !$item.my_responses.dislike}}fa-thumbs-o-down{{else}}fa-thumbs-down ivoted{{/if}}" ></i>
							</button>
							{{/if}}
						{{if $item.star && $item.star.isstarred}}
						<div class="btn-group" id="star-button-{{$item.id}}">
							<button type="button" class="clean-btn wall-item-like" onclick="dostar({{$item.id}});"><i class="fa fa-fw fa-star"></i></button>
						</div>
						{{/if}}
							{{if $item.comment && $item.thread_level > 1 && $item.thread_level < $item.thread_max }}
							<button type="button" title="{{$item.comment_lbl}}" class="clean-btn" onclick="openClose('wall-item-comment-wrapper-{{$item.id}}'); $('#comment-edit-text-{{$item.id}}').click(); return false;">
								<i class="fa fa-fw fa-reply"></i>
							</button>
							{{/if}}
							{{if $item.isevent}}
							<div class="btn-group">
								<button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-toggle="dropdown" id="wall-item-attend-menu-{{$item.id}}" title="{{$item.attend_title}}">
									<i class="fa fa-fw fa-calendar-check-o"></i>
								</button>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="#" title="{{$item.attend.0}}" onclick="itemAddToCal({{$item.id}}); dolike({{$item.id}},'attendyes'); return false;">
										<i class="item-act-list fa fa-fw fa-check{{if $item.my_responses.attend}} ivoted{{/if}}" ></i> {{$item.attend.0}}
									</a>
									<a class="dropdown-item" href="#" title="{{$item.attend.1}}" onclick="itemAddToCal({{$item.id}}), dolike({{$item.id}},'attendno'); return false;">
										<i class="item-act-list fa fa-fw fa-times{{if $item.my_responses.attendno}} ivoted{{/if}}" ></i> {{$item.attend.1}}
									</a>
									<a class="dropdown-item" href="#" title="{{$item.attend.2}}" onclick="itemAddToCal({{$item.id}}); dolike({{$item.id}},'attendmaybe'); return false;">
										<i class="item-act-list fa fa-fw fa-question{{if $item.my_responses.attendmaybe}} ivoted{{/if}}" ></i> {{$item.attend.2}}
									</a>
								</div>
							</div>
							{{/if}}
							{{if $item.canvote}}
							<div class="btn-group">
								<button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-toggle="dropdown" id="wall-item-consensus-menu-{{$item.id}}" title="{{$item.vote_title}}">
									<i class="fa fa-fw fa-check-square-o"></i>
								</button>
								<div class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="wall-item-consensus-menu-{{$item.id}}">
									<a class="dropdown-item" href="#" title="{{$item.conlabels.0}}" onclick="dolike({{$item.id}},'agree'); return false;">
										<i class="item-act-list fa fa-fw fa-check{{if $item.my_responses.agree}} ivoted{{/if}}" ></i> {{$item.conlabels.0}}
									</a>
									<a class="dropdown-item" href="#" title="{{$item.conlabels.1}}" onclick="dolike({{$item.id}},'disagree'); return false;">
										 <i class="item-act-list fa fa-fw fa-times{{if $item.my_responses.disagree}} ivoted{{/if}}" ></i> {{$item.conlabels.1}}
									</a> 
									<a class="dropdown-item" href="#" title="{{$item.conlabels.2}}" onclick="dolike({{$item.id}},'abstain'); return false;">
										<i class="item-act-list fa fa-fw fa-question{{if $item.my_responses.abstain}} ivoted{{/if}}" ></i> {{$item.conlabels.2}}
									</a>
								</div>
							</div>
							{{/if}}
						</div>
					</div>
                    {{if !$item.photo}}
					<div class="wall-item-ago"  id="wall-item-ago-{{$item.id}}">
					{{if $item.location}}<span class="wall-item-location p-location" id="wall-item-location-{{$item.id}}">{{$item.location}},&nbsp;</span>{{/if}}<span class="autotime" title="{{$item.isotime}}"><time class="dt-published" datetime="{{$item.isotime}}">{{$item.localtime}}</time>{{if $item.editedtime}}&nbsp;{{$item.editedtime}}{{/if}}{{if $item.expiretime}}&nbsp;{{$item.expiretime}}{{/if}}</span>{{if $item.editedtime}}&nbsp;<i class="fa fa-pencil"></i>{{/if}}&nbsp;{{if $item.delayed}}<i class="fa fa-clock-o"></i>&nbsp;{{/if}}{{if $item.app}}<span class="item.app">{{$item.str_app}}</span>{{/if}}
				    </div>
                    {{/if}}
				</div>

				{{if $item.photo && $item.body}}
				<div class="p-2 clearfix wall-item-head comment">
					{{if $item.pinned}}
						<span class="float-right wall-item-pinned" title="{{$item.pinned}}" id="wall-item-pinned-{{$item.id}}"><i class="fa fa-thumb-tack">&nbsp;</i></span>
					{{/if}}
					{{if $item.isdraft}}
						<span class="float-right wall-item-draft" title="{{$item.draft_txt}}" id="wall-item-draft-{{$item.id}}"><a href="editpost/{{$item.id}}"><i class="fa fa-floppy-o">&nbsp;</i></a></span>
					{{/if}}

					<div class="wall-item-info " id="wall-item-info-{{$item.id}}" >
						<div class="wall-item-photo-wrapper{{if $item.owner_url}} wwfrom{{/if}} h-card p-author" id="wall-item-photo-wrapper-{{$item.id}}">
							<img src="{{$item.thumb}}" class="fakelink wall-item-photo{{$item.sparkle}} u-photo p-name" id="wall-item-photo-{{$item.id}}" alt="{{$item.name}}" data-toggle="dropdown" />
							{{if $item.thread_author_menu}}
							<i class="fa fa-caret-down wall-item-photo-caret cursor-pointer" data-toggle="dropdown"></i>
							<div class="dropdown-menu">
								{{foreach $item.thread_author_menu as $mitem}}
								<a class="dropdown-item" {{if $mitem.href}}href="{{$mitem.href}}"{{/if}} {{if $mitem.action}}onclick="{{$mitem.action}}"{{/if}} {{if $mitem.title}}title="{{$mitem.title}}"{{/if}} >{{$mitem.title}}</a>
								{{/foreach}}

							</div>
							{{/if}}
						</div>
					</div>
					<div class="wall-item-author">
						{{if $item.previewing}}<span class="preview-indicator"><i class="fa fa-eye" title="{{$item.preview_lbl}}"></i></span>&nbsp;{{/if}}
						<a href="{{$item.profile_url}}" title="{{$item.linktitle}}" class="wall-item-name-link u-url"><span class="wall-item-name{{$item.sparkle}}" id="wall-item-name-{{$item.id}}" >{{$item.name}}</span></a>{{if $item.owner_url}}&nbsp;{{$item.via}}&nbsp;<a href="{{$item.owner_url}}" title="{{$item.olinktitle}}" class="wall-item-name-link"><span class="wall-item-name{{$item.osparkle}}" id="wall-item-ownername-{{$item.id}}">{{$item.owner_name}}</span></a>{{/if}}
					</div>
                </div>
				<div class="p-2 wall-item-content clearfix" id="wall-item-content-{{$item.id}}">
					<div class="wall-item-commentbody e-content" id="wall-item-body-{{$item.id}}" >
						{{$item.body}}
						{{* $item.comment_order *}}
					</div>
				</div>
				{{/if}}


				{{if $item.indentpx}}
				</div>
				{{/if}}
			</div>
		</div>
		{{if $item.collapsed}}
		</div>
		{{/if}}
		{{if $item.toplevel || $item.thread_level > 1 }}
		{{foreach $item.children as $child}}
			{{include file="{{$child.template}}" item=$child}}
		{{/foreach}}
		{{/if}}
		{{if $item.comment}}
		<div id="wall-item-comment-wrapper-{{$item.id}}" class="p-2 wall-item-comment-wrapper{{if $item.children}} wall-item-comment-wrapper-wc{{/if}}" {{if $item.thread_level > 1}} style="display:none;"{{/if}}>
			{{$item.comment}}
		</div>
		{{/if}}
	</div>
